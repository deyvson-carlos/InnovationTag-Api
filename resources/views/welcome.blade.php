<?php 

//  API de Orlando = Produtos

//   $url = "https://ficr-store.herokuapp.com/api/v1/products";
//   $ch = curl_init($url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//         $response = curl_exec($ch);
//         curl_close($ch);
 
//  $users = json_decode($response, true);
//  //$user = $users[0]["name"]; 

//      //var_dump($users);


// for ($i=0; $i < count($users); $i++) { 
//      echo "ID : ".$users[$i]["id"]. ", PRICE : ".$users[$i]["price"].  ", NAME = ".$users[$i]["name"]."<br>";

// echo "<hr>";

//  }

//===================================================================================



// API ORLANDO = CATEGORIES

//  $url = "https://ficr-store.herokuapp.com/api/v1/categories";
//  $ch = curl_init($url);
//          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//          $response = curl_exec($ch);
//          curl_close($ch);
 
//  $users = json_decode($response, true);
//  $user = $users[0]["name"]; 

//  //var_dump($users);

//  for ($i=0; $i < count($users); $i++) { 

//    echo "ID : ".$users[$i]["id"]. ", NAME : ".$users[$i]["name"]. "<br>";

//    echo "<hr>"; 
// }

//===================================================================================

// API ORLANDO = SUPPLIERS

// $url = "https://ficr-store.herokuapp.com/api/v1/suppliers";
// $ch = curl_init($url);
//       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//       $response = curl_exec($ch);
//       curl_close($ch);

// $users = json_decode($response, true);
// $user = $users[0]["name"]; 

// //var_dump($users);

// for ($i=0; $i < count($users); $i++) { 

//   echo "ID : ".$users[$i]["id"]. ", NAME : ".$users[$i]["name"].  ", PHONE : ".$users[$i]["phone"]. ", EMAIL : ".$users[$i]["email"]. "<br>";

//   echo "<hr>";

  
// }

//===================================================================================

// API ORLANDO = INVENTORIES

// $url = "https://ficr-store.herokuapp.com/api/v1/inventories";
// $ch = curl_init($url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     $response = curl_exec($ch);
//         curl_close($ch);

// $users = json_decode($response, true);
// $user = $users[0]["name"]; 

// //var_dump($users);

// for ($i=0; $i < count($users); $i++) { 

//   echo "ID : ".$users[$i]["id"]. ", UNITQT : ".$users[$i]["unitQt"]. "<br>";

//   echo "<hr>";

// }

//===================================================================================

// API JONATAS = produtos

// $url = "https://afternoon-fortress-37984.herokuapp.com/api/produtos";
// $ch = curl_init($url);
//       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//       $response = curl_exec($ch);
//       curl_close($ch);

// $users = json_decode($response, true);
// $user = $users['data']; 

// foreach ($user as $value) {
      
//       echo "id : {$value['id']} <br>";
//       echo "produto : {$value['attributes']['produto']} <br>";
//       echo "preco : {$value['attributes']['preco']} <br>";
     
//       echo "<hr>";

// }

//===================================================================================

// API JONATAS = VENDEDORES

// $url = "https://afternoon-fortress-37984.herokuapp.com/api/vendedores";
// $ch = curl_init($url);
//       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//       $response = curl_exec($ch);
//       curl_close($ch);

// $users = json_decode($response, true);
// $user = $users['data']; 

// foreach ($user as $value) {
      
//       echo "id : {$value['id']}<br>";
//       echo "email : {$value['attributes']['email']}<br>";
//       echo "idade : {$value['attributes']['idade']}<br>";
     
//       echo "<hr>";

// }

//===================================================================================

// API JONATAS = CLIENTES

// $url = "https://afternoon-fortress-37984.herokuapp.com/api/clientes";
// $ch = curl_init($url);
//       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//       $response = curl_exec($ch);
//       curl_close($ch);

// $users = json_decode($response, true);
// $user = $users['data']; 

// foreach ($user as $value) {
      
//       echo "id : {$value['id']}<br>";
//       echo "email : {$value['attributes']['email']}<br>";
//       echo "idade : {$value['attributes']['idade']}<br>";
//       echo "cep : {$value['attributes']['cep']}<br>";
//       echo "cpf : {$value['attributes']['cpf']}<br>";

//       echo "<hr>";

// }