<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('pcheck the validation of form and return success after submit');

$I->amOnPage('/surveyEntry.php');
$I->fillField('place','a');
$I->fillField('area','1200');
$I->fillField('price','25000');
$I->fillField('deposit','100000');
$I->fillField('lease','24');
$I->click('submit');
$I->seeCurrentUrlEquals('/surveyEntry.php');
$I->see('Success');
