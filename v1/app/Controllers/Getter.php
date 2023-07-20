<?php
namespace App\Controllers;
 
use App\Models\CryptocurrenciesModel;


class Getter extends BaseController
{
 
  
    public function index($id = null)
    {

      
      if ($id=="412580" OR $id=="0xdac17f958"){} else { exit; }
        
        
        $API_KEY= env("API_KEY", "0"); 
       
     
      	$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
 	
		$parameters = [ 'id' => '1,52,1027,3717,825,1966,3408,5994,7083,4943,5176,1975,3635,5015,5176,3575,3574,2781,2799', 'convert' => 'USD' ];

 
        $headers = [
          'Accepts: application/json',
          'X-CMC_PRO_API_KEY:'.$API_KEY

        ];
      
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
          CURLOPT_URL => $request,            // set the request URL
          CURLOPT_HTTPHEADER => $headers,     // set the headers 
          CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        $result   =	json_decode($response, true);
       
        curl_close($curl); // Close request

      
             $l=1;
              foreach ($result['data'] as &$value) {
              
              echo "<br>".$value['name'] ;
             
              echo "<br>".$value['symbol']  ;
              echo "<br>".$value['quote']['USD']['price'] ;
              echo "<br>".$value['quote']['USD']['percent_change_24h']; 
              echo "<br>".$value['quote']['USD']['percent_change_1h']; 
             
                if (isset($value['platform']['name'])){  $nameis= $value['platform']['name'];} else { $nameis="";}  
             	if (isset($value['platform']['token_address'])){ $token_address=$value['platform']['token_address'] ;} else {$token_address="";}  
   			    $precioEnDolares = $value['quote']['USD']['price'];
			    $tipoCambio = $result['data']['2799']['quote']['USD']['price'];
			  	$precioEnPesos = $this->convertirDolaresAPesos($precioEnDolares, $tipoCambio);
                

                $data = [
                  'id' => $l,
                  'codeID'       => $value['id'],
                  'name' => $value['name'],
                  'symbol'    => $value['symbol'],
                  'price_usd'    => $value['quote']['USD']['price'], 
                  'price_mxn'    => $precioEnPesos,        
                  'percent_change_24h'    => $value['quote']['USD']['percent_change_24h'],      
                  'percent_change_1h'    => $value['quote']['USD']['percent_change_1h'],
                  'token_address'    => $token_address,
                  'platform'    => $nameis,
                  
                ];

                $modelName = (new CryptocurrenciesModel)->save($data);

                $l++;
            }

      
      
	}
  
    private function convertirDolaresAPesos($precioEnDolares, $tipoCambio) {
      
    $precioEnPesos = $precioEnDolares / $tipoCambio;
      
    return $precioEnPesos;
   }

}