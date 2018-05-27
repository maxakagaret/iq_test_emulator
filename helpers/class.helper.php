<?php
/*====================================================*\
|| ################################################## ||
|| # IQ TEST EMULATOR                               # ||
|| # Helper class contains helper functions         # ||
|| # ---------------------------------------------- # ||
|| ################################################## ||
\*====================================================*/
class Helper{
	/**
	* Change values of question difficulties
	* @param int - number of team in data array
	* @param int - number of team in data array
	* @throws Exception if error
	**/
	public static function ChangeSettings($min, $max){
		global $MaxDB;
		$min=intval($min);
		$max=intval($max);
		if($min<0 || $max<0 || $min>=$max){
			throw new Exception("Error. WrongArguments", 1);
		}
		else{			
			$strSQL="SELECT `id` FROM `questions` ORDER BY `id` ASC";
			$questions=$MaxDB->Select($strSQL);
			if(is_array($questions) && !empty($questions)){
				foreach ($questions as $question) {
					$level = mt_rand($min,$max);
					$strSQL="UPDATE `questions` SET `level`=:level WHERE `id`=:quid";
					$result=$MaxDB->Update($strSQL,[':level',':quid'],[$level,$question['id']]);
					if($result!=0){
						throw new Exception("Error. Update error".$result, 1);
					}
				}
			}
			else{
				throw new Exception("Error. No questions", 1);
				
			}
		}
	}

	/**
	* Reset the questions setting
	* @throws Exception if error
	**/
	public static function Reset(){
		global $MaxDB;
		$strSQL="SELECT `id` FROM `questions` ORDER BY `id` ASC";
		$questions=$MaxDB->Select($strSQL);
		if(is_array($questions) && !empty($questions)){
			foreach ($questions as $question) {
				$level = mt_rand($min,$max);
				$strSQL="UPDATE `questions` SET `level`=0, `using`=0 WHERE `id`=:quid";
				$result=$MaxDB->Update($strSQL,[':level',':quid'],[$level,$question['id']]);
				if($result!=0){
					throw new Exception("Error. Update error".$result, 1);
				}
			}
		}
		else{
			throw new Exception("Error. No questions", 1);
			
		}
	}

	/**
	* Form the set of questions ids by it's using (roulette method)
	* @param array(mixed) - array of questions with it's ids and weight (`using`)
	* @return array(int) array of selected questions ids
	**/
	public static function FormRandomSet($questions){
		$randomSet = [];
		$weightsSum=0;
		
		foreach ($questions as $question) {
			$weightsSum+=$question['using'];
		}

		for($i=0; $i<40; $i++){
			// get sum of weights (`using` parameters)
			$tempWeightSum=$weightsSum;
			// get rand weight
			$randWeight = mt_rand(0,$tempWeightSum);
			$selectedIndex=-1;

			// select the element depending on weight
			foreach ($questions as $index => $question) {
				$tempWeightSum -= $question['using'];
				if($tempWeightSum<0){
					if(!in_array($question['id'], $randomSet)){
						$randomSet[]=$question['id'];
						$selectedIndex=$index;
						break;	
					}
				}
			}

			// if no element was selected select random one
			if($selectedIndex==-1){
				$flag=true;
				while($flag){
					$index=mt_rand(0,99);
					if(!in_array($questions[$index]['id'], $randomSet)){
						$randomSet[]=$questions[$index]['id'];
						$flag=false;
					}
				}
			}			
		}
		return $randomSet;
	}

	/**
	* Check does user successfuly answered the question or not
	* @param int - level of question dificutness
	* @param int - level of iq
	* @return bool successfully answered or not
	**/
	public static function QuestionResult($level, $iq){
		if($level==100){
			return false;
		}
		else{
			if($iq==100){
				return true;
			}
			elseif($iq==0){
				return false;
			}
			else{
				if($level==0){
					return true;
				}
				else{
					$luck = mt_rand(($iq-100)/2,(100-$iq)/2); // luck coefficient
					if($iq+$luck>$level){
						return true;
					}
					else{
						return false;
					}
				}
			}
		}
	}

	/**
	* Check does user successfuly answered the question or not
	* @param array(mixed) - array of questions with it's ids and weight (`using`)
	* @param int - level of iq
	* @return bool successfully answered or not
	**/
	public static function RunEmulator($questions, $iq){
		global $MaxDB;

		$randomSet=Helper::FormRandomSet($questions);
			
		$questionsResuts=[];
		$successQuestions=0;
		$maxLevel=0;
		$minLevel=100;
		for($i=0; $i<40; $i++){
			$strSQL="SELECT `level`,`using` FROM `questions` WHERE `id`=:qid";
			$controllQuestion=$MaxDB->SelectOne($strSQL,[':qid'],[$randomSet[$i]]);
			if(is_array($controllQuestion) && !empty($controllQuestion)){
				$strSQL="UPDATE `questions` SET `using`=:newusing WHERE `id`=:qid";
				$update = $MaxDB->Update($strSQL,[':newusing',':qid'],[$controllQuestion['using']+1,$randomSet[$i]]);
				$result = Helper::QuestionResult($controllQuestion['level'],$iq);
				
				if($minLevel>$controllQuestion['level']){
					$minLevel=$controllQuestion['level'];
				}
				if($maxLevel<$controllQuestion['level']){
					$maxLevel=$controllQuestion['level'];
				}
				if($result){
					$successQuestions++;
				}

				$questionsResuts[] = [
					'number'=>($i+1),
					'qid'=>$randomSet[$i],
					'qusing'=>$controllQuestion['using'],
					'qlevel'=>$controllQuestion['level'],
					'result'=>$result,
					'update'=>$update
				];
			}
		}

		$strSQL="INSERT INTO `tests` (`iq`,`levelmin`,`levelmax`,`result`) VALUES (:iq,:levelmin,:levelmax,:result)";
		$insert = $MaxDB->Insert($strSQL,[':iq',':levelmin',':levelmax',':result'],[$iq,$minLevel,$maxLevel,$successQuestions]);
		$strSQL="SELECT `id` FROM `tests` ORDER BY `id` DESC";
		$last=$MaxDB->SelectOne($strSQL);
		$newTest=['id'=>$last,'iq'=>$iq,'minlevel'=>$minLevel,'maxlevel'=>$maxLevel,'results'=>$successQuestions];

		return [
			'questionsResuts'=>$questionsResuts,
			'newTest'=>$newTest
		];
	}
}
?>