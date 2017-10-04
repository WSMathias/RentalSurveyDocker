<?php


class surveyEntryCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('../surveyEntry.php');
    }

    public function _after(FunctionalTester $I)
    {
        $I->amOnPage('../surveyEntry.php');
    }

    // tests
    public function testCorrectFields(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area','999900');
        $I->fillField('price','10000000');
        $I->fillField('deposit','900300');
        $I->fillField('lease','33');
        $I->click('submit');
        $I->see('Successfully submitted');
    }

    public function testAllIncorrectFields(FunctionalTester $I)
    {
        $I->fillField('place','%$^$^');
        $I->fillField('area','#%#$%');
        $I->fillField('price','$%^$%$^');
        $I->fillField('deposit','$%^$%^$^');
        $I->fillField('lease','$%^$%^$%%^');
        $I->click('submit');
        $I->see('Successfully submitted');
    }

    public function testInCorrectLocation(FunctionalTester $I)
    {
        $I->fillField('place','%**&(&*#&#*');
        $I->fillField('area','999900');
        $I->fillField('price','10000000');
        $I->fillField('deposit','900300');
        $I->fillField('lease','33');
        $I->click('submit');
        $I->see('Successfully submitted');
    }

    public function testIncorrectArea(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area','sdvsvdv');
        $I->fillField('price','10000000');
        $I->fillField('deposit','900300');
        $I->fillField('lease','33');
        $I->click('submit');
        $I->see('Successfully submitted');
    }
    public function testIncorrectPrice(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area','999900');
        $I->fillField('price','5');
        $I->fillField('deposit','900300');
        $I->fillField('lease','33');
        $I->click('submit');
        $I->see('Successfully submitted');
    }

}
