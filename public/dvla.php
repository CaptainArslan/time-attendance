<?php

 
try{
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>"{\n\t\"registrationNumber\": \"AA19AAA\"\n}",
    CURLOPT_HTTPHEADER => array(
        "x-api-key: cgRXq3U2W35C4AXrchW7T7lKqmjgqDIA6XrE7gqs",
        "Content-Type: application/json"
    ),
));

$httpCode = curl_getinfo($curl , CURLINFO_HTTP_CODE); // this results 0 every time
$response = curl_exec($curl);


curl_close($curl);

echo $response;

} catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
  return var_dump('Message: ' .$e->getMessage());

}
?>