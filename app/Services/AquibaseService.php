<?php
// app/Services/AquibaseService.php

use GuzzleHttp\Client;

class AquibaseService {
    private $client;
    private $baseUrl;
    private $username;
    private $password;
    
    public function __construct() {
        $this->baseUrl = "https://acquibase-api.acq.bluecode.ng"; // Set your environment URL
        $this->username = getenv('MERCHANT_ACCESS'); // Load from env/config
        $this->password = getenv('MERCHANT_SECRET');
        $this->client = new Client();
    }
    
    public function registerPayment($data) {
        $url = $this->baseUrl . "/v4/register";
        try {
            $response = $this->client->post($url, [
                'json' => $data,
                'auth' => [$this->username, $this->password]
            ]);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            // Handle exception
            return ['error' => $e->getMessage()];
        }
    }
    
    // Similarly, implement methods for payment, status, cancel, etc.
}
?>
