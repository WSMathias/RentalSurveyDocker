<?php


class surveyEntryCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/surveyEntry.php');
    }

    public function _after(FunctionalTester $I)
    {
        $I->seeCurrentUrlEquals('/surveyEntry.php');
    }

    // tests
    public function testAllValidInput(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',999900);
        $I->fillField('price',10000000);
        $I->fillField('deposit',900300);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('Successfully submitted');
    }

    public function testAllIncorrectInput(FunctionalTester $I)
    {
        $I->fillField('place','%$^$^');
        $I->fillField('area','#%#$%');
        $I->fillField('price','$%^$%$^');
        $I->fillField('deposit','$%^$%^$^');
        $I->fillField('lease','$%^$%^$%%^');
        $I->click('submit');
        $I->see('');
    }

    //Invalid Location Testing
    public function testInvalidLocationWithChar(FunctionalTester $I)
    {
        $I->fillField('place','%**&(&*#&#*');
        $I->fillField('area',999900);
        $I->fillField('price',100000);
        $I->fillField('deposit',90000);
        $I->fillField('lease',32);
        $I->click('submit');
        $I->see('special characters are not allowed');
    }

    public function testInvalidLocationWithAbsurdAddress(FunctionalTester $I)
    {
        $I->fillField('place','ABC, Karnataka, India');
        $I->fillField('area',999900);
        $I->fillField('price',10000000);
        $I->fillField('deposit',900300);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('');
    }
    public function testInvalidLocationWithInteger(FunctionalTester $I)
    {
        $I->fillField('place',123);
        $I->fillField('area',999900);
        $I->fillField('price',10000000);
        $I->fillField('deposit',900300);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('');
    }
    public function testInvalidLocationWithFloat(FunctionalTester $I)
    {
        $I->fillField('place',12.3);
        $I->fillField('area',999900);
        $I->fillField('price',10000000);
        $I->fillField('deposit',900300);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('');
    }

    //Invalid Area Testing
    public function testInvalidAreaWithChar(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area','@@$%');
        $I->fillField('price',50000);
        $I->fillField('deposit',900300);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('special characters are not allowed');
    }
    public function testInvalidAreaWithString(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area','abcsd');
        $I->fillField('price',50000);
        $I->fillField('deposit',100000);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('');
    }
    public function testInvalidAreaWithOutOfRangeI(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',1);
        $I->fillField('price',50000);
        $I->fillField('deposit',100000);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('Out of range');
    }
    public function testInvalidAreaWithOutOfRangeII(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',100000000000);
        $I->fillField('price',50000);
        $I->fillField('deposit',100000);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('Out of range');
    }
    
    //Invalid Price Testing
    public function testInvalidPriceWithChar(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',1000);
        $I->fillField('price','@#$*&');
        $I->fillField('deposit',100000);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('special characters are not allowed');
    }
    public function testInvalidPriceWithString(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',5000);
        $I->fillField('price','abcsd');
        $I->fillField('deposit',100000);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('');
    }
    public function testInvalidPriceWithOutOfRangeI(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',10000);
        $I->fillField('price',5);
        $I->fillField('deposit',100000);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('Out of range');
    }
    public function testInvalidPriceWithOutOfRangeII(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',500);
        $I->fillField('price',100000000000);
        $I->fillField('deposit',100000);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('Out of range');
    }

    //Invalid deposit Testing
    public function testInvalidDepositWithChar(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',1000);
        $I->fillField('price',50000);
        $I->fillField('deposit','@#$*&');
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('special characters are not allowed');
    }
    public function testInvalidDepositWithString(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',5000);
        $I->fillField('price',10000);
        $I->fillField('deposit','abcsd');
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('');
    }
    public function testInvalidDpositWithOutOfRangeI(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',10000);
        $I->fillField('price',50000);
        $I->fillField('deposit',1);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('Out of range');
    }
    public function testInvalidDepositeWithOutOfRangeII(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',500);
        $I->fillField('price',10000);
        $I->fillField('deposit',1000000000000);
        $I->fillField('lease',33);
        $I->click('submit');
        $I->see('Out of range');
    }
    
    //Invalid lease Testing
    public function testInvalidWithChar(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',1000);
        $I->fillField('price',50000);
        $I->fillField('deposit',1000000);
        $I->fillField('lease','@#$*&');
        $I->click('submit');
        $I->see('special characters are not allowed');
    }
    public function testInvalidLeaseWithString(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',5000);
        $I->fillField('price',10000);
        $I->fillField('deposit',)50000;
        $I->fillField('lease','abcsd');
        $I->click('submit');
        $I->see('');
    }
    public function testInvalidLeaseWithOutOfRangeI(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',10000);
        $I->fillField('price',50000);
        $I->fillField('deposit',100000);
        $I->fillField('lease',1);
        $I->click('submit');
        $I->see('Out of range');
    }
    public function testInvalidDepositeWithOutOfRangeII(FunctionalTester $I)
    {
        $I->fillField('place','Bengaluru, Karnataka, India');
        $I->fillField('area',500);
        $I->fillField('price',10000);
        $I->fillField('deposit',100000);
        $I->fillField('lease',496);
        $I->click('submit');
        $I->see('Out of range');
    }

}
