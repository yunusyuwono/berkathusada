<?php 
include 'koneksi.php';
$nfa=$_POST['nofaktur'];
$tglf=$_POST['tglf'];
$gnt=mysqli_query($kon,"UPDATE apotek_trk set tglfaktur='$tglf' where nofaktur='$nfa'");
if($gnt)
{
	echo 1;
}
else
{
	echo mysqli_error($kon);
}