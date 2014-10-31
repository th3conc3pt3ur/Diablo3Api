<?php
//********************************** //
//  	DIABLO 3 LIBS   		  	 //	

define("API_KEY","VOTRE_CLE_API_ICI"); // A REMPLACER PAR LA VOTRE BIEN ENTENDU
$tabClasse = array("barbarian","crusader","demon-hunter","monk","witch-doctor","wizard");
$tabColor = array("rgba(255,255,0,","rgba(0,255,255,","rgba(255,0,255,");

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
		$this->battleTag = "TheDragon-2486";
		$this->region = "eu";
		$this->locale = "fr_FR";
		$this->account = $this->getAccount(); // chargement des données de base
	}

	function getAccount() // va chercher le fichier .json de base sur l'api D3 et le décode.
	{
		$url = "https://".$this->region.".api.battle.net/d3/profile/".$this->battleTag."/?locale=".$this->locale."&apikey=".$this->API_KEY; // Account
		return json_decode(file_get_contents($url));
	}
	function getCharacterListe()
	{
		return $this->account->heroes;
	}
	function getTimePlayed() // renvoie en % le temps de jeu par classe
	{
		$timePlayed = get_object_vars($this->account->timePlayed);
		$cptTotal = 0;
		foreach ($timePlayed as $key => $value) {
                $cptTotal += $value;
        }
        foreach ($timePlayed as $key => $value) {
        	$timePlayed[$key] = round((100*$value)/$cptTotal);
        }
        return $timePlayed;
	}
	function getTimePlayedSaison() // renvoie le temps de jeu en saison par classe
	{
		$PlayedSaison = get_object_vars($this->account->seasonalProfiles);
        $tabPlayedSaison = array();

        foreach ($PlayedSaison as $key => $value) {
        	$tabPlayedSaison[$value->seasonId] = get_object_vars($value->timePlayed);
        }
		for ($i=0; $i < count($tabPlayedSaison) ; $i++) { 
        	$TabcptTotal[$i] = 0;
        }
        foreach ($tabPlayedSaison as $key => $value) {
        	foreach ($value as $key2 => $value2) {
            	$TabcptTotal[$key] += $value2;
            }   
        }
        foreach ($tabPlayedSaison as $key => $value) {
        	foreach ($value as $key2 => $value2) {
            	$tabPlayedSaison[$key][$key2] = round((100*$value2)/$TabcptTotal[$key]);
            }
        }
        return $tabPlayedSaison;
	}
	function getKills() // renvoi dans un tableau le nombre de kill sur monstre élite et les monstres hardcore
	{
		return array($this->account->kills->monsters,$this->account->kills->elites,$this->account->kills->hardcoreMonsters);
	}

}
?>
