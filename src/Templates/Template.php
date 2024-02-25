<?php 
namespace App\Templates;
use App\Models\Setting;
abstract class Template{
    protected $title;
    protected $setting;
    public function __construct(){
      $settingmodel= new Setting( );
      $this->setting=$settingmodel->getFirstData();
    }
    public function getHead(){
        ?>


        <?php

    }
}