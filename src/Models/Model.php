<?php
namespace App\Models;
use App\Classes\Database;
use App\Exeptions\DoesNotExistsExeption;

abstract class Model{
    private $database;
    protected $fileName;
    protected $entityClass;
    public function __construct(){
        $this->database= new Database($this->fileName,$this->entityClass); 

    }
    public function getAllData(){ 
        return $this->database->getData();
    }
    
    public function getDataByTId($id){
        $data = $this->database->getData();
        $array=array_filter($data,function($item) use ($id){
            return $item->getId() == $id;
        });
        $array=array_values($array); 
        if (count($array))
            return $array[0];
        throw new DoesNotExistsExeption("Does not exist any {$this->entityClass} "); 
    }
    public function getLastData(){
        $data = $this->database->getData();
        uasort($data,function($item1,$item2) {
            if ($item1->getId() > $item2->getId())
               return -1;
            else return 1;
        });
        $data= array_values($data);
        if (count($data))
        return $data[0];
        else
        throw new DoesNotExistsExeption("Does not exist any {$this->entityClass} "); 

    }
    public function getFirstData(){
        $data = $this->database->getData();
        uasort($data,function($item1,$item2) {
            if ($item1->getId() < $item2->getId())
               return -1;
            else return 1;
        });
        $data= array_values($data);
        if (count($data))
        return $data[0];
        
        throw new DoesNotExistsExeption("Does not exist any {$this->entityClass} "); 

    }
    public function sortData($callback){
        $data = $this->database->getData();
        uasort($data,$callback);
        $data= array_values($data);
        if (count($data))
        return $data;
        
        throw new DoesNotExistsExeption("Does not exist any {$this->entityClass} "); 

    }
    public function filterData($callback){
        $data = $this->database->getData();
        $data = array_filter($data,$callback);
      
        $data = array_values($data);
        if (count($data))
        return $data;        
        throw new DoesNotExistsExeption("Does not exist any {$this->entityClass} "); 

    }
    
    public function createData($new){
        $data = $this->database->getData();
        $data[] = $new;
        $this->database->setData($data) ;
        return true;
    }

    
    public function deleteData($id){
        $data=$this->database->getData();
        $newarray=array_filter($data,function($item) use($id){
         return  ($item->getId() ==$id) ? false:true;           
        });

        $newarray =array_values($newarray);
        $this->database->setData($newarray) ;
        return true;
    }
    public function editData($new){
        $data=$this->database->getData();
        $data1= array_map(function($item) use($new){
            return ($item->getId() ==$new->getId()) ? $new:$item;
        },$data);
        $data1=array_values($data1);
        $this->database->setData($data1) ;   
        return true;
    }
     
}