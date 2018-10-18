<?php

namespace WebAppId\Content\Tests\Unit\Repositories;

use WebAppId\Content\Repositories\LanguageRepository;
use WebAppId\Content\Tests\TestCase;

use Illuminate\Container\Container;

class LanguageTest extends TestCase
{
    private $language;

    private $objLanguage;

    public function start()
    {
        $container = new Container;
        $this->language = $container->make(LanguageRepository::class);
        $this->objLanguage = new \StdClass;
    }

    public function createDummy()
    {
        $this->objLanguage->code = $this->faker->word;
        $this->objLanguage->name = $this->faker->word;
        $this->objLanguage->image_id = '1';
        $this->objLanguage->user_id = '1';
    }

    public function createLanguage()
    {
        $this->createDummy();
        return $this->language->addLanguage($this->objLanguage);
    }

    public function setUp()
    {
        parent::setUp();
        $this->start();
    }

    public function testAddLanguage()
    {
        $result = $this->createLanguage();
        if (!$result) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
            $this->assertEquals($this->objLanguage->code, $result->code);
            $this->assertEquals($this->objLanguage->name, $result->name);
        }
    }
    
    public function testGetAllLanguage(){
        $result = $this->createLanguage();
        if (!$result) {
            $this->assertTrue(false);
        } else {
            $resultAllLanguage = $this->language->getLanguage(); 
            if(count($resultAllLanguage)>0){
                $this->assertTrue(true);
            }else{
                $this->assertTrue(false);
            }
        }
    }

    public function testGetLanguageByName(){
        $result = $this->createLanguage();
        if (!$result) {
            $this->assertTrue(false);
        } else {
            $resultLanguage = $this->language->getLanguageByName($this->objLanguage->name); 
            if($resultLanguage==null){
                $this->assertTrue(false);
            }else{
                $this->assertTrue(true);
            }
        }
    }
}
