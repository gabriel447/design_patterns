<?php

require __DIR__ . '/../../../vendor/autoload.php';

// Interface comum para clientes HTTP
interface HttpClientInterface {
    public function request(string $url, string $method = 'GET', array $options = []): string;
}

// Cliente HTTP usando cURL
class CurlHttpClient implements HttpClientInterface {
    public function request(string $url, string $method = 'GET', array $options = []): string {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (strtoupper($method) === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if (isset($options['body'])) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $options['body']);
            }
        }

        // Additional options can be set here if needed

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            throw new Exception("cURL error: " . $error_msg);
        }

        curl_close($ch);
        return $response ?: '';
    }
}

// Cliente HTTP usando Guzzle
// Note: Guzzle must be installed via Composer for this to work
use GuzzleHttp\Client;

class GuzzleHttpClient implements HttpClientInterface {
    private Client $client;

    public function __construct() {
        $this->client = new Client();
    }

    public function request(string $url, string $method = 'GET', array $options = []): string {
        $response = $this->client->request($method, $url, $options);
        return $response->getBody()->getContents();
    }
}

// Código cliente que usa a interface HttpClientInterface
function makeRequest(HttpClientInterface $client, string $url) {
    try {
        $response = $client->request($url);
        echo "Response from " . get_class($client) . ":\n";
        echo substr($response, 0, 200) . "\n\n"; // Print first 200 chars
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}

// Exemplo de uso
$url = "https://jsonplaceholder.typicode.com/posts/1";

echo "=== Using CurlHttpClient ===\n";
$curlClient = new CurlHttpClient();
makeRequest($curlClient, $url);

echo "=== Using GuzzleHttpClient ===\n";
$guzzleClient = new GuzzleHttpClient();
makeRequest($guzzleClient, $url);

?>
