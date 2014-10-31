<?php
//********************************** //
//  	DIABLO 3 LIBS   		  	 //	

define("API_KEY","VOTRE API KEY"); // A REMPLACER PAR LA VOTRE BIEN ENTENDU

class ApiDiablo3
{
	

	private $battleTag; // battle tag de la forme XXXX#000
	private $region; // eu,us,kr,tw,cn
	private $locale; // fr_FR,es_ES,en_GB,ru_RU,de_DE,pt_PT,it_IT
	private $API_KEY = API_KEY;
	private $url;
	private $account;
	
	function __construct()
	{
		$this->account = $this->getAccount(); // chargementt des données de base
	}

	function getAccount()
	{
		$url = "https://".$this->region.".api.battle.net/d3/profile/".$this->battleTag."/?locale=".$this->locale."&apikey=".$this->API_KEY; // Account
		return file_get_contents($url);
	}
	function getCharacterListe()
	{
		return $this->account->heroes;
	}
	function getTimePlayed()
	{
		$timePlayed = get_object_vars($this->account->timePlayed);
		foreach ($timePlayed as $key => $value) {
                $cptTotal += $value;
        }
        foreach ($timePlayed as $key => $value) {
        	$timePlayed[$key] = round((100*$value)/$cptTotal);
        }
	}

}
?>
