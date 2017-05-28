<html>
<head>
<link rel="stylesheet" href="https://ateista.pl/images/MyBBPro/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://ateista.pl/images/MyBBPro/octicons/octicons.css" />
<link type="text/css" rel="stylesheet" href="https://ateista.pl/cache/themes/theme3/global.css" />
<link type="text/css" rel="stylesheet" href="https://ateista.pl/cache/themes/theme3/bootstrap-fixes.css" />
<link type="text/css" rel="stylesheet" href="https://ateista.pl/cache/themes/theme3/css3.css" />
<link type="text/css" rel="stylesheet" href="https://ateista.pl/cache/themes/theme3/color-5.css" />
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
</head>
<body style="background-color: #f7f7ff;">
<?php
if(array_key_exists("ulist",$_POST))
{
	$u_list=$_POST["ulist"];
	$users=explode(" ",$u_list);
	$i=0;
	while(array_key_exists($i,$users)) $i++;
	$f=fopen("users.dat","w");
	if(strcmp($users[0],"no_bot"))
	{
		fwrite($f,$i);
		fwrite($f,"\n");
		for($j=0;$j<$i;$j++)
			fwrite($f,$users[$j]."\n");
	}
	else
	{
		fwrite($f,"none");
	}
	fclose($f);
}
else
{
	$f=fopen("users.dat","r");
	$l=fgets($f);
	if(!strcmp($l,"none"))
		echo("<p><span style=\"color: #27699f\"><b>Aktualnie na kanale nie ma AteBota.</b></span></p>\n");
	else
	{
		echo("<p><span style=\"color: #27699f\"><b>\nNa IRCu ");
        if($l==1) echo("obecna jest 1 osoba.");
        if($l>=2 && $l<=4) echo("obecne są ".$l." osoby.");
        if($l>=5) echo("obecnych jest ".$l." osób.");
        echo("<br />\n</b></span>\n");
		echo("\n<span style=\"font-size: 8pt;\"><b>Obecni na kanale:</b><br/>\n");
		while(!feof($f))
		{
			$l=fgets($f);
			echo($l."<br/>\n");
		}
		fclose($f);
		echo("</span></p>\n");
	}
}
?>
</body>
</html>
