<?php
/*====================================================*\
|| ################################################## ||
|| # MAXS BEEJEE TEST                               # ||
|| # Database class                                 # ||
|| #                                                # ||
|| # ---------------------------------------------- # ||
|| # Copyright 2016 Maxim Savin All Rights Reserved # ||
|| ################################################## ||
\*====================================================*/

class SecureMySQLI{
	private $host;
	private $dbtype;
	private $dbname;
	private $login;
	private $password;
	public function __construct($_host,$_dbtype,$_dbname,$_login,$_password){
		$this->host=$_host;
		$this->dbtype=$_dbtype;
		$this->dbname=$_dbname;
		$this->login=$_login;
		$this->password=$_password;
	}
	private function ArgumentsTypes($arguments){
		$types='';
		for($i=0;$i<count($arguments);$i++){
			if (is_float($arguments[$i])){$types.='d';}
			elseif (is_integer($arguments[$i])){$types.='i';}
			elseif (is_string($arguments[$i])){$types.='s';}
			else{$types.='b';}	
		}
		return $types;
	}
	private function Execute($strSQL,$argsNames,$args){
		try{
			$mysqli=new PDO($this->dbtype.':host='.$this->host.';dbname='.$this->dbname.';charset=utf8', $this->login, $this->password);
			$mysqli->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
			if($stmt=$mysqli->prepare($strSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
				if($args!=null){
					$combiArgs=[];
					for($i=0;$i<count($args);$i++){
						$combiArgs[$argsNames[$i]]=$args[$i];
					}
					$result=$stmt->execute($combiArgs)?0:$stmt->errorInfo()[2];
					$stmt->closeCursor();
					$mysqli=null;
					return $result;
				}
				$result=$stmt->execute()?0:$stmt->errorInfo()[2];
				$stmt->closeCursor();
				$mysqli=null;
				return $result;
			}
			$mysqli=null;
			return "Wrong statement";
		}
		catch (PDOException $e){
    		return "Error!: " . $e->getMessage() . "<br/>";
		}
	}
	public function Insert($strSQL,$argsNames=null,$args=null){
		return $this->Execute($strSQL,$argsNames,$args);
	}
	public function Update($strSQL,$argsNames=null,$args=null){
		return $this->Execute($strSQL,$argsNames,$args);
	}
	public function Delete($strSQL,$argsNames=null,$args=null){
		return $this->Execute($strSQL,$argsNames,$args);
	}
	private function ExecuteSelect($onlyOne,$strSQL,$argsNames=null,$args=null){
		try{
			$mysqli=new PDO($this->dbtype.':host='.$this->host.';dbname='.$this->dbname.';charset=utf8', $this->login, $this->password);
			$mysqli->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
			if($stmt=$mysqli->prepare($strSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
				if($args!=null){
					$combiArgs=[];
					for($i=0;$i<count($args);$i++){
						$combiArgs[$argsNames[$i]]=$args[$i];
					}
					if($stmt->execute($combiArgs)){
						if($onlyOne){
							$result = $stmt->fetch();
						}
						else{
							$result = $stmt->fetchAll();
						}
						$stmt->closeCursor();
						$mysqli=null;
						return $result;
					}
					$result=$stmt->errorInfo()[2];
					$stmt->closeCursor();
					$mysqli=null;
					return $result;
				}
				if($stmt->execute()){				
					if($onlyOne){
						$result = $stmt->fetch();
						$result = $result[0];
					}
					else{
						$result = $stmt->fetchAll();	
					}
					$stmt->closeCursor();
					$mysqli=null;
					return $result;
				}
				$result=$stmt->errorInfo()[2];
				$stmt->closeCursor();
				$mysqli=null;
				return $result;
			}
			$result=$mysqli->errorInfo();
			$mysqli=null;
			return $result;
		}
		catch (PDOException $e){
    		return "Error!: " . $e->getMessage() . "<br/>";
		}
	}
	public function Select($strSQL,$argsNames=null,$args=null){
		return $this->ExecuteSelect(false,$strSQL,$argsNames,$args);
	}
	public function SelectOne($strSQL,$argsNames=null,$args=null){
		return $this->ExecuteSelect(true,$strSQL,$argsNames,$args);
	}
	public function NumRows($strSQL,$argsNames=null,$args=null){
		try{
			$mysqli=new PDO($this->dbtype.':host='.$this->host.';dbname='.$this->dbname.';charset=utf8', $this->login, $this->password);
			$mysqli->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
			if($stmt=$mysqli->prepare($strSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY))){
				if($args!=null){
					$combiArgs=[];
					for($i=0;$i<count($args);$i++){
						$combiArgs[$argsNames[$i]]=$args[$i];
					}
					if($stmt->execute($combiArgs)){
						$result=$stmt->rowCount();
						$stmt->closeCursor();
						$mysqli=null;
						return $result;
					}
					$result=$stmt->errorInfo()[2];
					$stmt->closeCursor();
					$mysqli=null;
					return $result;
				}
				if($stmt->execute()){				
					$result=$stmt->rowCount();
					$stmt->closeCursor();
					$mysqli=null;
					return $result;
				}
				$result=$stmt->errorInfo()[2];
				$stmt->closeCursor();
				$mysqli=null;
				return $result;
			}
			return -1;
		}
		catch (PDOException $e){
    		return "Error!: " . $e->getMessage() . "<br/>";
		}
	}
}
?>