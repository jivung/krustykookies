<h1>Readme</h1>
<h2><b>1. Inloggning</b></h2>
<p class="breadtext">
För att logga in i systemet finns ett antal alternativ, listade nedan.<br /><br />
<u><b>OBS!</b></u><br />
<b>Lösenordet</b> är detsamma för alla dessa initiala kontotyper, i detta fall "<b>password</b>" (utan citationstecken).<br /><br />
Detta för att förenkla testningen. Om kontona är nyskapade av testpersoner är det lösenordet som angetts vid skapandet som gäller.
<ul>
	<li class="heading">
	1.1 Logga in som superuser
	</li>
	<li class="item">
	Användarnamn: superuser
	</li>
	<li class="heading">
	1.2 Logga in som kund
	</li>
	<li class="item">
	Användarnamnen för att logga in som de olika kunderna är företagsnamnet minus ändelsen. För att exempelvis logga in som företaget "Bjudkakor AB" så är användarnamnet endast "bjudkakor" (givetvis utan citationstecken).
	</li>
	<li class="heading">
	1.3 Logga in som admin
	</li>
	<li class="item">
	Användarnamn: admin
	</li>
	<li class="heading">
	1.4 Logga in som arbetare på produktions-avd.
	</li>
	<li class="item">
	Användarnamn: produktion
	</li>
	<li class="heading">
	1.5 Logga in som arbetare på order-avd.
	</li>
	<li class="item">
	Användarnamn: order
	</li>
	<li class="heading">
	1.6 Logga in som arbetare på materal/recept-avd.
	</li>
	<li class="item">
	Användarnamn: material
	</li>
</ul>
</p>
<h2><b>2. Navigering av systemet</b></h2>
<p class="breadtext">
Efter inloggning möts man av systemets startsida, med meny för tillgängliga operationer till vänster i gränssnittet. För att återkomma till startsidan (om man nu vill det), klickar man på logotypen.<br /><br />
För utloggning, klicka på knappen "Logga ut" uppe till höger, och du återvänder till inloggingssidan.
</p>
<h2><b>2.1 Superuser</b></h2>
<p class="breadtext">
En superuser har tillgång till systemets alla funktioner, förutom kundinterfacet.
</p>
<h2><b>2.2 Kund</b></h2>
<p class="breadtext">
En kund kan lägga nya beställningar, visa sina beställningar, samt uppdatera företagsinformation.<br /><br />
<u>Observera</u> att vid skapande av nya kundkonton MÅSTE kunden logga in och göra en första uppdatering av sin företagsinformation (fullständigt företagsnamn, samt address bestående av stad) INNAN beställningar läggs.
</p>
<h2><b>2.3 Admin</b></h2>
<p class="breadtext">
En administratör kan skapa nya användkonton av de olika kontotyperna, samt radera existerande konton.
</p>
<h2><b>2.4 Produktion</b></h2>
<p class="breadtext">
Användare av produktionsgränssnittet kan producera nya pallar av valt recept, söka på pallar, samt blockera pallar.
</p>
<h2><b>2.5 Ordrar & leveranser</b></h2>
<p class="breadtext">
Användare av ordergränssnittet kan se kunders lagda beställningar, samt simulera utskick och leverans av dessa.
</p>
<h2><b>2.6 Material & Recept</b></h2>
<p class="breadtext">
Användare av material/receptgränssnittet kan se tillgängliga ingredienser, mängden i lager av varje ingrediens, samt senaste inleverans av en ingrediens (mängd och datum). Dessa användare kan även simulera inleverans av valda ingredienser.
</p>
<h2><b>3. Viktig information</b></h2>
<p class="breadtext">
Om det vid testning av systemet ej går att logga in på något konto, så har dessa troligtvis raderats av Dig eller tidigare testare. För att åtgärda detta går det alltid att logga in som superuser	(som inte kan raderas), och lägga till nya användarkonton att köra sina tester med.
<br /><br />
Notera att, som tidigare nämnts; vid skapande av nya kundkonton krävs det att företagsinformationen uppdateras (företagsnamn, address) för att kunna lägga beställningar.
</p>