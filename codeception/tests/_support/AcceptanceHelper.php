<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I
//class AcceptanceHelper extends \AcceptanceTester
class AcceptanceHelper extends \Codeception\Module
{
    public function grabTagCount ($I,$tags,$position='0'){
        $tag = explode(" ",$tags);
        $I->executeJS("var container = document.createElement('input');
	container.id = 'length';
        container.type = 'hidden';
	container.value = document.getElementsByTagName(\"$tag[0]\")[$position].getElementsByTagName(\"$tag[1]\").length;
	document.body.insertBefore(container, document.body.firstChild)");
        $I->wait("1");
        $lines = $I->grabValueFrom('#length');
        return $lines;
    }
    public function assertEquals($expected, $actual, $message = '') {
        parent::assertEquals($expected, $actual, $message);
    }
    public function fail($message) {
        parent::fail($message);
    }
    public function grabClassCount ($I,$class){
        $I->executeJS("var container = document.createElement('input');
	container.id = 'length';
        container.type = 'hidden';
	container.value = document.getElementsByClassName(\"$class\").length;
	document.body.insertBefore(container, document.body.firstChild)");
        $I->wait("1");
        $lines = $I->grabValueFrom('#length');
        return $lines;
    }
}
//document.getElementsByClassName('frame_label no_connection d_b').length