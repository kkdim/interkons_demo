<?php
class Log
{
	public $tekst;
	public function __construct($tekst)
	{
		$this->tekst=$tekst;
	}
	
	public function upis()
	{
		$pom=date("d.m.Y H:i:s", time())." - ".$this->tekst."\r\n";
		$f=fopen("log/log.txt", "a");
		fwrite($f, $pom);
		fclose($f);
	}
	public function upisLogovanje()
	{
		$pom=date("d.m.Y H:i:s", time())." - ".$this->tekst."\r\n";
		$f=fopen("log/logovanje.txt", "a");
		fwrite($f, $pom);
		fclose($f);
	}
	public function upisVesti()
	{
		$pom=date("d.m.Y H:i:s", time())." - ".$this->tekst."\r\n";
		$f=fopen("log/vesti.txt", "a");
		fwrite($f, $pom);
		fclose($f);
	}
}
?>