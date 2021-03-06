<?php
require_once realpath(dirname(__FILE__) . '/../../../..') . '/enviroment.php';
require_once APPPATH.'modules/mod_discount/models/discount_model_admin.php';
doLogin();
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-07-03 at 18:00:22.
 */
class Discount_model_adminTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Discount_model_admin
     */
    protected $object;
    protected $discountKey = '87046de8c6hzy2kl';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Discount_model_admin();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    /**
     * Prepare test data
     * @covers Discount_model_admin::all
     */
    public function testPrepareTestData() {
        $this->_prepareData();
    }

    /**
     * @covers Discount_model_admin::getMainCurrencySymbol
     * @todo   Implement testGetMainCurrencySymbol().
     */
    public function testGetMainCurrencySymbol() {
        $result = $this->object->getMainCurrencySymbol();
        $this->assertInternalType('string', $result);
    }

    /**
     * @covers Discount_model_admin::checkDiscountCode
     * @todo   Implement testCheckDiscountCode().
     */
    public function testCheckDiscountCode() {
        $this->assertTrue($this->object->checkDiscountCode($this->discountKey));
        $this->assertFalse($this->object->checkDiscountCode('1111222233334444'));
    }

    /**
     * @covers Discount_model_admin::getUsersByIdNameEmail
     * @todo   Implement testGetUsersByIdNameEmail().
     * @dataProvider getUsersByTermParametrs
     */
    public function testGetUsersByIdNameEmail($term, $param) {
        $result = (boolean)$this->object->getUsersByIdNameEmail($term);
        $this->assertEquals($param,$result);
        
    }
    public function getUsersByTermParametrs() {
        return array(
            array(1,true),
            array(0041,false),
            array('jdsabfsadbsad',false),
            array('ad@min.com',true),
            array('admin',true),
            array('asdasas@dsfgvcx.sdfk',false)
        );
    }

    /**
     * @covers Discount_model_admin::getUserGroups
     * @todo   Implement testGetUserGroups().
     */
    public function testGetUserGroups() {
        $result = (boolean) $this->object->getUserGroups();
        $this->assertTrue($result);
    }

    /**
     * @covers Discount_model_admin::getProductsByIdNameNumber
     * @todo   Implement testGetProductsByIdNameNumber().
     * @dataProvider getProductsByIdNameNumberParams
     */
    public function testGetProductsByIdNameNumber($term,$param) {
        $result = (boolean)$this->object->getProductsByIdNameNumber($term);
        $this->assertEquals($param,$result);
    }
    public function getProductsByIdNameNumberParams() {
        return array(
            array(999999,true),
            array(03100,false),
            array('VIXIA',true),
            array('akj2323ksda',false)
        );
    }

    /**
     * @covers Discount_model_admin::insertDataToDB
     * @todo   Implement testInsertDataToDB().
     */
    public function testInsertDataToDB() {
        $data = array (
                    'name' => 'name',
                    'key' => 'key123key123ke12',
                    'max_apply' => 5,
                    'type_value' => 1,
                    'value' => 50,
                    'type_discount' => 'comulativ',
                    'date_begin' => time(),
                    'date_end' => time()+1234,
                    'active' => '1'
                );
        $result = (boolean) $this->object->insertDataToDB('mod_shop_discounts', $data);
        $this->assertEquals($result, true);
        $data['date_begin']='121515155';
        $data['key']='12312432kdasdfgh';
        $result = (boolean) $this->object->insertDataToDB('mod_shop_discounts', $data);
        $this->assertEquals($result, true);
    }

    /**
     * @covers Discount_model_admin::updateDiscountById
     * @todo   Implement testUpdateDiscountById().
     */
    public function testUpdateDiscountById() {
        $data = array (
                    'name' => 'name',
                    'key' => 'key123asd123ka12',
                    'max_apply' => 5,
                    'type_value' => 1,
                    'value' => 50,
                    'type_discount' => 'comulativ',
                    'date_begin' => time(),
                    'date_end' => time()+111234,
                    'active' => '0'
                );
        $typeDiscountData = array(
            'id' => 1,
            'discount_id' => 1,
            'begin_value' => 9999,
        );
        $result = $this->object->updateDiscountById(1, $data, $typeDiscountData);
        $this->assertEquals($result, true);
    }

    /**
     * @covers Discount_model_admin::checkHaveAnyComulativDiscountMaxEndValue
     * @todo   Implement testCheckHaveAnyComulativDiscountMaxEndValue().
     * @dataProvider CheckHaveAnyComulativDiscountMaxEndValueParams
     */
    public function testCheckHaveAnyComulativDiscountMaxEndValue($id, $param) {
        $result = $this->object->checkHaveAnyComulativDiscountMaxEndValue($id);
        
        $this->assertEquals($result, $param);
    }
    public function CheckHaveAnyComulativDiscountMaxEndValueParams(){
        return array(
            array(1,false),
            array(98765432,true),
            array('VIXIA',true),
        );
    }

    /**
     * @covers Discount_model_admin::getDiscountAllDataById
     * @todo   Implement testGetDiscountAllDataById().
     * @dataProvider getDiscountAllDataByIdParams
     */
    public function testGetDiscountAllDataById($id, $param) {
        $result = (boolean)$this->object->getDiscountAllDataById($id);
        $this->assertEquals($result, $param);
    }
    public function getDiscountAllDataByIdParams(){
        return array(
            array(1,true),
            array('a23',false),
            array(987654,false),
        );
    }

    /**
     * @covers Discount_model_admin::getUserNameAndEmailById
     * @todo   Implement testGetUserNameAndEmailById().
     * @dataProvider getUserNameAndEmailByIdParams
     */
    public function testGetUserNameAndEmailById($id,$param) {
        $result = (boolean) $this->object->getUserNameAndEmailById($id);
        $this->assertEquals($result, $param);
        
    }
    public function getUserNameAndEmailByIdParams(){
        return array(
            array(1,true),
            array('a23',false),
            array(98765432,false),
        );
    }

    /**
     * @covers Discount_model_admin::getProductById
     * @todo   Implement testGetProductById().
     * @dataProvider getProductByIdParams
     */
    public function testGetProductById($id, $param) {
        $result = (boolean) $this->object->getProductById($id);
        $this->assertEquals($result, $param);
    }
    public function getProductByIdParams() {
        return array(
            array(999999,true),
            array(03100,false),
            array('VIXIA',false),
            array('akj2323ksda',false)
        );
    }
    
    /**
     * Prepare test data
     * @covers Discount_model_admin::all
     */
    public function testCleareData(){
        $this->_cleareData();
    }
    
    /**
     * Prepare data for tests. Install/Deinstall and insert testing values
     */
    private function _prepareData(){
        $this->object->discount_model_admin->moduleDelete();
        $this->object->discount_model_admin->moduleInstall();
        $sql = "INSERT INTO `mod_shop_discounts` (`id`, `key`, `name`, `active`, `max_apply`,
                `count_apply`, `date_begin`, `date_end`, `type_value`, `value`, `type_discount`)
                VALUES (1, '87046de8c6hzy2kl', 'test', 1, NULL, NULL, 1372795200, 0, 1, 
                50, 'comulativ');";
        $this->object->db->query($sql);
        $sql2 = "INSERT INTO `image`.`mod_discount_comulativ` (`id` ,`discount_id` ,
                `begin_value` , `end_value`)VALUES (
                '1', '1', '1000', NULL);";
        $this->object->db->query($sql2);
        
        $sql3="INSERT INTO `image`.`shop_products_i18n` (`id`, `locale`, `name`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`) 
            VALUES ('999999', 'ru', 'Canon VIXIA HF R11 Digital','','' , '', '', '');";
        
        $this->object->db->query($sql3);
    }
    

    /**
     * Cleare data.
     */
    private function _cleareData(){
        $sql="DELETE FROM `image`.`shop_products_i18n` WHERE `shop_products_i18n`.`id` = 999999;";
        $this->object->db->query($sql);
        
        $sql2="DELETE FROM `image`.`mod_shop_discounts` WHERE `mod_shop_discounts`.`key` = 'key123key123ke12'";
        $this->object->db->query($sql2);
        
        $sql3="DELETE FROM `image`.`mod_shop_discounts` WHERE `mod_shop_discounts`.`key` = '12312432kdasdfgh'";
        $this->object->db->query($sql3);
    }

}
