<?php
use \AcceptanceTester;

include_once __DIR__.'\DeliveryHelper.php';

class DeliveryEditCest extends DeliveryTestHelper{
        
    public $name = "ДоставкаРедактирование";
    
    /**
     * Works after Autorization
     * @staticvar int $callCount 0 - first time didn't work, 
     *                           >0 - searching current delivery in list 
     * 
     * @var bool $methodCreated true if current method($this->name) finded in list
     *                          if false Create new delivery method for edit      
     *                   
     * @param AcceptanceTester $I Contoller
     */
    public function _before(AcceptanceTester $I) {
        static $callCount = 0;
        $methodCreated = false;
        if ($callCount > 0){
            $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
            $rows = $I->grabClassCount($I, 'niceCheck')-1;
            for($row=1;$row<=$rows;++$row){
                $Cmethod = $I->grabTextFrom(DeliveryPage::ListMethodLine($row));
                if ($this->name == $Cmethod){
                    $methodCreated = true;
                    $I->click(DeliveryPage::ListMethodLine($row));
                    break;
                }   
            }
            if (!$methodCreated){
                $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
                $I->click(DeliveryPage::$CreateButton);
                $I->waitForText("Создание способа доставки", NULL, '.title');
                $this->CreateDelivery($I, $this->name);
                $this->CheckForAlertPresent($I, 'success');
                $methodCreated = true;
            }
            $I->waitForText("Редактирование способа доставки: $this->name", NULL, ".title");
        }    
        $callCount++;
    }
    
    /**
     * @group current
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
    }
 
    //-----------------------FIELD NAME TESTS-----------------------------------    
    /**
     * @group edit
     */
    public function ENameEmpty(AcceptanceTester $I)
    {
        $this->EditDelivery($I, ['name'=>'',]);
        $this->CheckForAlertPresent($I, 'required', NULL, DeliveryEditPage::$FieldName,$module="edit");
    }
    
    /**
     * @group edit
     */
    public function EName250(AcceptanceTester $I)
    {
        $name = InitTest::$text250;
        $this->EditDelivery($I, ['name' => $name]);
        $this->CheckForAlertPresent($I, "success",NULL,NULL,'edit');
        $this->CheckInList($I, $name);
        $this->name = $name;
    }
    /**
     * @group edit
     */
    public function EName500(AcceptanceTester $I) {
        $name = InitTest::$text500;
        $this->EditDelivery ($I, ['name' => $name]);
        $this->CheckForAlertPresent($I, 'success',null, null, "edit");
        $this->CheckInList($I, $name);
        $this->name = $name;
    }
    /**
     * @group edit
     */
    public function EName501(AcceptanceTester $I) {
        $name = InitTest::$text501;
        $this->EditDelivery($I, ['name'=>$name]);
        $this->CheckForAlertPresent($I, 'error', NULL, NULL, 'edit');
        $I->see("Редактирование способа доставки: ".$this->name,'.title');
        }

     /**
     * @group edit
     */
    public function ENameSymbols(AcceptanceTester $I) {
        $name = InitTest::$textSymbols;
        $this->EditDelivery($I, ['name' => $name]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInList($I, $name);
    }
    
     /**
     * @group edit
     */
    public function ENameNormal(AcceptanceTester $I) {
        $name = "ДоставкаРедактирование";
        $this->EditDelivery($I, ['name' => $name]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInList($I, $name);
    }
    
    //-----------------------CHECKBOX ACTIVE TESTS------------------------------
    
    /**
     * @group edit
     */
    public function EActiveCheck(AcceptanceTester $I) {
        $active = 'on';
        $this->EditDelivery($I, ['active' => $active]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInList($I, $this->name, $active);
    }
    
    /**
     * @group edit
     */
    public function EActiveUnCheck(AcceptanceTester $I) {
        $active = 'off';
        $this->EditDelivery($I, ['active' => $active]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInList($I, $this->name, $active);
    }
    
    //-----------------------FIELD DESCRIPTION TESTS----------------------------
    
    /**
     * @group edit
     */
    public function EDescriptionDescriptionPrice(AcceptanceTester $I) {
        $description = InitTest::$textSymbols;
        $this->EditDelivery($I, ['description'      => $description,
                                 'descriptionprice' => $description,
                                 'active'           => 'on',
                                ]);
        $I->seeInField(DeliveryEditPage::$FieldDescription, $description);
        $I->seeInField(DeliveryEditPage::$FieldDescriptionPrice, $description);
        $this->CheckInFrontEnd($I, $this->name, $description);
    }
    
    //-----------------------FIELDS PRICE & FREE FROM TESTS---------------------

    /**
     * @group edit
     */
    public function EPriceSymbols(AcceptanceTester $I) {
        $price = InitTest::$textSymbols;
        $this->EditDelivery($I, ['price' => $price]);
        $price = '1234567890';
        $this->CheckInList($I, $this->name, NULL, $price);
    }
    
    /**
     * @group edit
     */
        public function EFreeFromSymbols(AcceptanceTester $I) {
        $freefrom = InitTest::$textSymbols;
        $this->EditDelivery($I, ['freefrom' => $freefrom]);
        $this->CheckForAlertPresent($I, 'success');
        $freefrom = '1234567890';
        $this->CheckInList($I, $this->name, null, null, $freefrom);
    }
    
    /**
     * @group edit
     */
    public function EPrice15Num(AcceptanceTester $I) {
        $price = 9999999999.999;
        $this->EditDelivery($I, ['price' => $price]);
        $this->CheckInList($I, $this->name, NULL, $price);
    }
    
    /**
     * @group edit
     */
    public function EPrice1Num(AcceptanceTester $I){
        $price = 1;
        $this->EditDelivery($I, ['price' => "$price"]);
        $this->CheckInList($I, $this->name, NULL, $price);
    }

    /**
     * @group edit
     */
    public function EPrice10Num(AcceptanceTester $I) {
        $price = 55555.55555;
        $this->EditDelivery($I, ['price' => $price]);
        $this->CheckInList($I, $this->name, NULL, $price);
    }

    /**
     * @group edit
     */
        public function EFreeFrom1Num(AcceptanceTester $I) {
        $freefrom = 1;
        $this->EditDelivery($I, ['freefrom' => $freefrom]);
        $this->CheckInList($I, $this->name, null, null, $freefrom);
    }
    
    /**
     * @group edit
     */
        public function EFreeFrom10Num(AcceptanceTester $I) {
        $freefrom = 55555.55555;
        $this->EditDelivery($I, ['freefrom' => $freefrom]);
        $this->CheckInList($I, $this->name, null, null, $freefrom);
    }
    
    /**
     * @group edit
     */
        public function EFreeFrom15Num(AcceptanceTester $I) {
        $freefrom = 9999999999.999;
        $this->EditDelivery($I, ['freefrom' => $freefrom]);
        $this->CheckInList($I, $this->name, null, null, $freefrom);
    }
    
    //---------------------CHECKBOX PRICE SPECIFIED & FIELD PRICE SPECIFIED-----
    
    /**
     * @group edit
     */
    public function ECheckPriceSpecified(AcceptanceTester $I) {
        $class = $I->grabAttributeFrom(DeliveryEditPage::$CheckboxPriceSpecified.'/..', 'class');
        $I->comment($class);
        $class == 'frame_label no_connection active'? $I->click(DeliveryEditPage::$CheckboxPriceSpecified):print"";
        $class = $I->grabAttributeFrom(DeliveryEditPage::$CheckboxPriceSpecified.'/..', 'class');
        if ($class == 'frame_label no_connection'){
            $diabledPrice = $I->grabAttributeFrom(DeliveryEditPage::$FieldPrice, 'disabled');
            $diabledFreefrom = $I->grabAttributeFrom(DeliveryEditPage::$FieldFreeFrom, 'disabled');
            $I->assertEquals($diabledPrice, NULL);
            $I->assertEquals($diabledFreefrom, NULL);
        }else $I->fail ('wrong class of checkbox sum specified');
        
        $I->click(DeliveryCreatePage::$CheckboxPriceSpecified);
        $class = $I->grabAttributeFrom(DeliveryEditPage::$CheckboxPriceSpecified.'/..', 'class');
        
        if ($class == 'frame_label no_connection active'){
            $diabledPrice = $I->grabAttributeFrom(DeliveryEditPage::$FieldPrice, 'disabled');
            $diabledFreefrom = $I->grabAttributeFrom(DeliveryEditPage::$FieldFreeFrom, 'disabled');
            $I->assertEquals($diabledPrice, "true");
            $I->assertEquals($diabledFreefrom, "true");
        }else $I->fail ('wrong class of checkbox sum specified');
    }
    
    /**
     * @group edit
     */
    public function EPriceSpecifiedEmpty(AcceptanceTester $I) {
        $this->EditDelivery($I, ['message' => ""]);
        $this->CheckForAlertPresent($I, 'success', NULL, NULL, 'edit');
    }
    
    /**
     * @group edit
     */
    public function EPriceSpecified250(AcceptanceTester $I) {
        $message = InitTest::$text250;
        $this->EditDelivery($I, ['message' => $message]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInFrontEnd($I, $this->name, null, null, null, $message);
    }
    
    /**
     * @group edit
     */
    public function EFieldPriceSpecified500(AcceptanceTester $I) {
        $message = InitTest::$text500;
        $this->EditDelivery($I, ['message' => $message]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInFrontEnd($I, $this->name, null, null, null, $message);
    }
    
    /**
     * @group edit
     */
    public function EFieldPriceSpecified501(AcceptanceTester $I){
        $message = InitTest::$text501;
        $this->EditDelivery($I, ['message' => $message]);
        $this->CheckForAlertPresent($I, 'error', NULL, null, 'edit');
    }
    
    /**
     * @group edit
     */
    public function EFieldPriceSpecifiedSymbols(AcceptanceTester $I) {
        $message = InitTest::$textSymbols;
        $this->EditDelivery($I, ['message' => $message]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInFrontEnd($I, $this->name, null, null, null, $message);
    }
    
    //---------------------PAYMENT METHODS FIELD--------------------------------
    
    /**
     * @group current
     */
    public function EDeliveryPaymentVerify(AcceptanceTester $I){
        $pay = $this->GrabAllCreatedPayments($I);
        $row = 1;
        
        $this->_before($I);
        
        foreach ($pay as $Currentpay) {
            $I->comment($Currentpay);
            $CreatePagePay = $I->grabTextFrom(DeliveryEditPage::PaymentMethodLabel($row));
            $I->assertEquals($CreatePagePay, $Currentpay);
            $row++;
        }
    }
    
    /**
     * @group edit
     */
    public function EDeliveryPaymentEmpty(AcceptanceTester $I){
        $pay = $this->GrabAllCreatedPayments($I);
        $this->_before($I);
        $this->EditDelivery($I, ['payoff' => $pay]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInFrontEnd($I, $this->name, NULL, null, null, null, 'off');
    }
    
    /**
     * @group edit
     */
    public function EDeliveryPaymentAll(AcceptanceTester $I){
        $pay = $this->GrabAllCreatedPayments($I);
        $this->_before($I);
        $this->EditDelivery($I, ['pay' => $pay]);
        $this->CheckForAlertPresent($I, 'success', null, null, 'edit');
        $this->CheckInFrontEnd($I, $this->name, NULL, null, null, null, $pay);
        
    }
    
    
    //-------------PROTECTED FUNCTIONS------------------------------------------
    
    /**
     * 
     * @todo EditDelivery protected Method
     * @param array $params name                => 'Deliveryname',
     * @param array $params active              => 'off - disabled | on - enabled',
     * @param array $params description         => 'Delivery description',
     * @param array $params descriptionprice    => 'Delivery price description',
     * @param array $params price               => 'Delivery price',
     * @param array $params freefrom            => 'Delivery freefrom',
     * @param array $params message             => 'Delivery sum specified message',
     * @param array $params pay                 => 'Select payment methods, array or sring '_' - delimiter for few methods',
     * @param array $params payoff              => 'Unselect payment methods, array or sring '_' - delimiter for few methods',
     */
    protected function EditDelivery(AcceptanceTester $I,$params) {
        $default_params =[  'name'              => NULL,
                            'active'            => NULL,
                            'description'       => NULL,
                            'descriptionprice'  => NULL,
                            'price'             => NULL,
                            'freefrom'          => NULL,
                            'message'           => NULL,
                            'pay'               => NULL,
                            'payoff'            => NULL,
        ];
        $params = array_merge($default_params,$params);
        extract($params);
        if(isset($name)){
            $I->fillField(DeliveryEditPage::$FieldName, $name);
        }
        
        if(isset($active)) {
            $Cactive = $I->grabAttributeFrom("//*[@id='deliveryUpdate']/div[2]/div[2]/span", 'class');
            $Cactive == 'frame_label no_connection active'?$Cactive = TRUE:$Cactive = FALSE;
            if      ($active == "on" && !$Cactive)   { $I->click(DeliveryEditPage::$CheckboxActive); }
            elseif  ($active == "off" && $Cactive)   { $I->click(DeliveryEditPage::$CheckboxActive); }
        }
        
        if(isset($description))         { $I->fillField(DeliveryEditPage::$FieldDescription, $description); }
        
        if(isset($descriptionprice))    { $I->fillField(DeliveryEditPage::$FieldDescriptionPrice, $descriptionprice); }
        
        if(isset($price))               { 
            $I->grabAttributeFrom(DeliveryEditPage::$FieldPrice, 'disabled')== 'true'?$I->click(DeliveryEditPage::$CheckboxPriceSpecified):  print '';
            $I->fillField(DeliveryEditPage::$FieldPrice,$price);
        }
        
        if(isset($freefrom))            { 
            $I->grabAttributeFrom(DeliveryEditPage::$FieldPrice, 'disabled')== 'true'?$I->click(DeliveryEditPage::$CheckboxPriceSpecified):  print '';
            $I->fillField(DeliveryEditPage::$FieldFreeFrom, $freefrom);
        }
        
        if(isset($message))             { 
            $class = $I->grabAttributeFrom(DeliveryEditPage::$CheckboxPriceSpecified.'/..', 'class');
            $class == 'frame_label no_connection'?$I->click(DeliveryEditPage::$CheckboxPriceSpecified):$I->comment('already marked');
            $I->fillField(DeliveryEditPage::$FieldPriceSpecified, $message);
        }
        if(isset($pay))                 {
            if (is_string($pay)) { $pay = explode("_", $pay); }
            if (is_array($pay))  {
                $row = 1;
                foreach ($pay as $value) {
                    $Cclass = $I->grabAttributeFrom(DeliveryEditPage::PaymentMethodLabel($row), 'class');
                    $row++;
                    
                    if($Cclass == 'frame_label no_connection d_b'){
                        $I->click("//span[contains(.,\"$value\")]");
                    }
                    
                }
            }  
            else { $I->fail("Unknown type"); }
        }
        
        if(isset($payoff))                 {
            if (is_string($payoff)) { $pay = explode("_", $pay); }
            if (is_array($payoff))  {
                $row = 1;
                foreach ($payoff as $value) {
                    $Cclass = $I->grabAttributeFrom(DeliveryEditPage::PaymentMethodLabel($row), 'class');
                    $row++;
                    
                    if($Cclass == 'frame_label no_connection d_b active'){
                        $I->click("//span[contains(.,\"$value\")]");
                    }
                    
                }
            }  
            else { $I->fail("Unknown type"); }
        }
        
        $I->click(DeliveryEditPage::$ButtonSave);
        
    }
}