#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$link = $_GET["file"];
$link=urldecode($link);
$exec = "rm -f /tmp/log.txt";
$ret=exec($exec);
$h=file_get_contents($link);
$t1=explode("streamer=",$h);
$t2=explode("file=",$t1[1]);
$t3=explode("&",$t2[1]);
$y=$t3[0];
$exec = "/usr/local/etc/www/cgi-bin/scripts/rtmpdump -V -v -r rtmp://live.ilive.to/redirect -y ".$y." -W http://static.ilive.to/jwplayer/player.swf -p http://ilive.to  2>/tmp/log.txt";
$ret=exec($exec,$a);
$h=file_get_contents("/tmp/log.txt");
$t1=explode("redirect, STRING:",$h);
$t2=explode(">",$t1[1]);
$rtmp=trim($t2[0]);
$t1=explode(".",$y);
$file=$t1[0];
$opt="Rtmp-options:-W http://static.ilive.to/jwplayer/player.swf -p http://ilive.to";
$opt=$opt." -y ".$file.",".$rtmp;
$opt=str_replace(" ","%20",$opt);
print $opt;
?>