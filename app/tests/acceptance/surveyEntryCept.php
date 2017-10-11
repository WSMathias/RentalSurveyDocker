<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('pcheck the validation of form and return success after submit');

$I->amOnPage('/surveyEntry.php');
$I->fillField('place','Bengaluru, Karnataka, India');
$I->fillField('area','999900');
$I->fillField('price','10000000');
$I->fillField('deposit','900300');
$I->fillField('lease','33');
$I->click('submit');
$I->seeCurrentUrlEquals('/surveyEntry.php');
$I->see('Successfully submitted');
