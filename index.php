<?php
/*====================================================*\
|| ################################################## ||
|| # IQ TEST EMULATOR                               # ||
|| # Main file                                      # ||
|| # ---------------------------------------------- # ||
|| ################################################## ||
\*====================================================*/
include_once ('init.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(
		isset($_POST['action']) && $_POST['action']=='config' && 
		isset($_POST['min']) && $_POST['min']>=0 &&
		isset($_POST['max']) && $_POST['max']>=0){
		try{
			Helper::ChangeSettings($_POST['min'],$_POST['max']);
			die(json_encode(['status'=>true]));
		}
		catch(Exception $ex){
			die(json_encode(['status'=>false,'error'=>$ex->getMessage()]));	
		}
	}
	elseif(
		isset($_POST['action']) && $_POST['action']=='emulate' && 
		isset($_POST['iq']) && $_POST['iq']>=0){

		$iq=intval($_POST['iq']);
		
		$strSQL="SELECT `id`,`using` FROM `questions` ORDER BY `using` DESC ";
		$questions=$MaxDB->Select($strSQL);

		if(is_array($questions) && !empty($questions)){
			
			$results=Helper::RunEmulator($questions, $iq);

			die(json_encode(['status'=>true,'results'=>$results['questionsResuts'],'insert'=>$results['newTest']]));
		}
		else{
			die(json_encode(['status'=>false,'error'=>"No questions"]));	
		}
	}
	else{
		die(json_encode(['status'=>false,'error'=>'Wrong Arguments']));
	}
}
else{	
	$strSQL="SELECT * FROM `tests` ORDER BY `id` ASC";
	$tests=$MaxDB->Select($strSQL);
	$strSQL="SELECT MAX(`level`) FROM `questions`";
	$maxLevel=$MaxDB->SelectOne($strSQL);
	$strSQL="SELECT MIN(`level`) FROM `questions`";
	$minLevel=$MaxDB->SelectOne($strSQL);
	if (!file_exists('view/mainpage.php')) die('[index.php] mainpage view not exist');
	include_once('view/mainpage.php');
}
?>