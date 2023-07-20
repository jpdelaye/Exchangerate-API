<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CryptocurrenciesModel;

 
  
class Cryptocurrencies extends ResourceController
{
    protected $modelName = 'App\Models\CryptocurrenciesModel';
    protected $format    = 'json';

    public function index()
    {
       // return $this->respond($this->model->findAll());
      
        return $this->genericResponse($this->model->findAll(), "" , "200");
    
    }
  
   public function show( $symbol = null)
    {
       // return  $this->respond($this->model->where('symbol', $symbol )->findAll());
     
           if ($symbol == null){

              return $this->genericResponse(null , "Symbol is null" , "500");
          }
     
     $cryptoSymbol = $this->model->where('symbol', $symbol )->findAll();
     
     if (!$cryptoSymbol){
         return $this->genericResponse(null , "Symbol does not  exist" , "500");
     }
     
     return $this->genericResponse($this->model->where('symbol', $symbol )->findAll(), "" , "200");
     
     
     
    }
  
  
  
  
   private function genericResponse( $data, $msg, $code ){
     
     
         if ($code=="200"){
			 
           return $this->respond(array(
             "data" => $data, 
             "code" => $code));
          
         }else{
			 
           return $this->respond(array( 
             "msg" => $msg , 
             "code" =>$code
            ));

            
         } 
     
    }
     
  
  

   
}