<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foursquare extends CI_Controller { 
 
	public function index()
	{

	 if ($_POST) {	 	
	  
	 	 $dizi['sonuc']=$this->curl(); 	 

	 }
 
	 $dizi['sonuc']="";//json_decode($this->curl());
	 $this->load->view('api_sonuc',$dizi);
	}
	public function ajax()
	{ error_reporting(0);
		  $sorgu=trim($this->input->post('sorgu'));
		if (strlen($sorgu)>1) {
			 $sonuc=json_decode($this->curl($sorgu));
	  		if($sonuc->meta->code != 200){  
			  echo '<div class="error">Herhangi bir mekan bulunamadı.  '.$venues->meta->errorType . ':'. $venues->meta->errorDetail.'</strong></div>'; 
			} else {
				$body="";
			  foreach($sonuc->response->venues as $key){
   				 // $key->name.'<br>';
   				 $body.='<tr>';
   				 $body.='<td>'.$key->name.'</td>';
   				 $body.='<td>'.$key->categories[0]->name.'</td>';
   				 $body.='<td>'.$key->location->city.'</td>';
   				 $body.='<td>'.$key->location->address.'</td>';
   				 $body.='<td>'.$key->location->lat.','.$key->location->lng.'</td>'; 
   				 $body.='</tr>';

			  }

			  echo $table='<table   class="table">
       					 <thead>
       					     <tr>
       					         <th>Mekan Adı</th>
       					         <th>Kategori</th>
       					         <th>Şehir</th>
       					         <th>Adres</th> 
       					         <th>Kordinatlar</th>
       					     </tr>
       					 </thead>
   						 <tbody>
   						 '.$body.' 
   	   					 <tbody> 
					 </table>';
		 	}
		}
		 
	}


	private function curl($sorgu){		
 
	$param = array(
		'client_id' =>"YICMH2LAG1VHHETMMROI5HOGQAIZK3LCD5YEZXENSQJ2NIJ0",
		'client_secret' =>"VU4NCEFVCR0C2BTMUN50GTUARRHRXPP1PZCKNLYXJLGFTLAY",
		'll' => "39.0014506,30.6868348", // türkiye  
		'query' =>$sorgu,
	 	//'near' =>"",
		//'radius' =>"" ,
		//'query' => "",
		//'limit' => "2",
		//'categoryId' =>"" ,
		//'llAcc' =>"" ,
		//'alt' =>"" ,
		//'altAcc' =>"" ,
		//'url' =>"" ,
		//'providerId' => "",
		//'linkedId' => "",  
		'v' => date('Ymd')
	 );

	  $useragent = 'Mozilla/5.0 (compatible; Googlebot/2.1; +[urlhttp://www.google.com/bot.html)';
	  $header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
	  $header[] = "Cache-Control: private, max-age=0";
	  $header[] = "Connection: keep-alive";
	  $header[] = "Keep-Alive: 115";
	  $header[] = "Accept-Charset: ISO-8859-9,utf-8;q=0.7,*;q=0.7";
	  $header[] = "Accept-Language: tr-TR,tr;q=0.8,en-us;q=0.5,en;q=0.3";
	  $header[] = "Pragma: ";
	 $url="https://api.foursquare.com/v2/venues/search";
	$ch = curl_init(); 
	$data = http_build_query($param);
	$getUrl = $url."?".$data;
	curl_setopt ($ch, CURLOPT_URL, $getUrl); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt ($ch, CURLOPT_HTTPHEADER , $header); 
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER , false); 	 
	curl_setopt ($ch, CURLOPT_USERAGENT, $useragent); 
	$return = curl_exec($ch); 
	curl_close($ch); 
	return $return;
	}

	 
}
