<?php
require_once("includes/setup.php");
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/header.php");
?>

<h1>Hej och välkommen<?php $db->openConnection(); if($db->checkCustomer($_SESSION['username'])) { ?>, kära kund<?php } $db->closeConnection(); ?>!</h1>

<?php
$db->openConnection(); 
if(!$db->checkCustomer($_SESSION['username'])) {
?>
<p class="breadtext">
	Du är inloggad som <b><?php echo $_SESSION['username'] ?></b>, och har <i>
	<?php 
		$db->openConnection();
		if($db->checkSuperUser($_SESSION['username'])) {
	?>
	alla 
	<?php	
		} else if($db->checkProductionUser($_SESSION['username'])) {
	?>
	produktions-
	<?php	
		} else if($db->checkMaterialUser($_SESSION['username'])) {
	?>
	material-
	<?php	
		} else if($db->checkOrderAndDeliveryUser($_SESSION['username'])) {
	?>
	order-
	<?php	
		} else {
	?>
	inga 
	<?php	
		}
		$db->closeConnection();
	?>
	</i>privilegier.
</p>
<?php
} else {
?>
<p class="breadtext">
	Vi på Krusty Kookies är otroligt glada över att just Ni har bestämt er för det mycket kloka valet av just Oss som Eder leverantör av kakor och diverse bakverk. 
	Vi är ett anrikt, men tillika modernt företag med en ständig strävan efter att ligga i branschens absoluta framkant.
</p>

<h2>Med oss som leverantör är inte längre kvalitet och kvantitet motpoler</h2>
<p class="normaltext">
	Med en mångårig rutin och erfarenhet av såväl bakverk som branschens helhet, i kombination med moderna produktionsmetoder och affärssystem, kan vi garantera top notch-produkter 
	till oslagbara priser. Genom att själva tillhandahålla alla steg i produktionskedjan, från beställning till levererad produkt, säkerställer vi en kvalitetsmärkt vara - samtidigt som 
	kostnader hålls nere. 
</p>
<h2>Alla steg är viktiga steg på vägen till succé</h2>
<p class="normaltext">
	Även våra kringliggande system utvecklas, manövreras och underhålls inom egna led. På så sätt lämnas inget åt slumpen när vi tar fram den bästa lösningen för oss, och framförallt Er.
	Detta system Ni i denna stund använder är ett ypperligt exempel på den fingertoppskänsla som blivit kutym här på Krusty Kookies.
</p>
<h2>Strömlinjeformad perfektion</h2>
<p class="normaltext">
	Från ojäst deg bland hårt arbetande fabriksknegare, till smulor på 59-åriga Elsas böljande buk under det lokala kvarterets månatliga kafferep, sprider Krusty Kookies kakor utan undantag sin omisskänliga glädje milsvid.
	<br />
	<br />
	<i>Det är så vi arbetar, helt enkelt.</i>
</p>
<p class="normaltext">
- Michael Jivung, VD
</p>
<?php } ?>
<?php $db->openConnection(); if(!$db->checkCustomer($_SESSION['username'])) { ?>
<p class="normaltext">
	Använd menyn till vänster för att manövrera systemet. Vid eventuella frågor, alternativt support, hänvisas till valen högst upp till höger på sidan.<br/>
</p>
<p class="footnote">
	Jobba på så chefen blir nöjd, och kom ihåg att ha en trevlig arbetsdag! (OBS! inga kaffepauser på arbetstid)
</p>
<?php } else { ?>
<p class="footnote">
	Använd menyn till vänster för att manövrera systemet. Vid eventuella frågor, alternativt support, hänvisas till valen högst upp till höger på sidan.<br/>
</p>
<p class="footnote">
	
</p>
<?php } $db->closeConnection();?>
<?php
require_once("includes/footer.php");
?>