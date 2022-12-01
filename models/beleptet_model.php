<?php

class Beleptet_Model
{
	public function get_data($vars)
	{
		$retData['eredmeny'] = "";
		if(isset($vars['elonevReg']) && isset($vars['utonevReg']) && isset($vars['felhasznalonevReg']) && isset($vars['jelszoReg'])){
			$regData = $this->regisztracio($vars);
			$retData['uzenet'] = $regData['uzenet'];
		}
		
		if(isset($vars['login']) && isset($vars['password'])){
			try {
				$connection = Database::getConnection();
				$sql = "SELECT id, csaladi_nev, uto_nev, login_nev FROM felhasznalo WHERE login_nev='".$vars['login']."' and jelszo='".sha1($vars['password'])."'";
				$stmt = $connection->query($sql);
					$felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC);
				switch(count($felhasznalo)) {
					case 0:
						$retData['eredmeny'] = "ERROR";
						$retData['uzenet'] = "Helytelen felhasználói név-jelszó pár!";
						break;
					case 1:
						$retData['eredmény'] = "OK";
						$retData['uzenet'] = "Kedves ".$felhasznalo[0]['csaladi_nev']." ".$felhasznalo[0]['uto_nev']."!<br><br>
						                      Jó munkát kívánunk rendszerünkkel.<br><br>
											  Az üzemeltetők";
						$_SESSION['userid'] =  $felhasznalo[0]['id'];
						$_SESSION['username'] = $felhasznalo[0]['login_nev'];
						$_SESSION['userlastname'] =  $felhasznalo[0]['csaladi_nev'];
						$_SESSION['userfirstname'] =  $felhasznalo[0]['uto_nev'];
						break;
					default:
						$retData['eredmény'] = "ERROR";
						$retData['uzenet'] = "Több felhasználót találtunk a megadott felhasználói név -jelszó párral!";
				}
			}
			catch (PDOException $e) {
						$retData['eredmény'] = "ERROR";
						$retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
			}
		}
		return $retData;
	}


	private function regisztracio($vars)
	{
		$retData = array();

		try {
			$connection = Database::getConnection();

			$sqlSelect = "SELECT id FROM felhasznalo WHERE login_nev = '".$vars['felhasznalonevReg']."'";
        	$sth = $connection->prepare($sqlSelect);
        	$sth->execute();
			
			$retData['select'] = $row = $sth->fetchAll(PDO::FETCH_ASSOC);

        	if(count($row)) {
        	    $retData['uzenet'] = "A felhasználói név már foglalt!";
        	}
			else {


				$sqlInsert = "INSERT INTO felhasznalo(login_nev, csaladi_nev, uto_nev, jelszo)
						VALUES('".$vars['felhasznalonevReg']."', '".$vars['elonevReg']."', '".$vars['utonevReg']."', '".sha1($vars['jelszoReg'])."')";
				$sth = $connection->prepare($sqlInsert);
				$sth->execute();
				$retData['uzenet'] = "Sikeres regisztráció!";

			}

			}

			catch (PDOException $e) {
				$retData['eredmény'] = "ERROR";
				$retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
			}
			return $retData;
	}

}
?>


