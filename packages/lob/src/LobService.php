<?php

namespace OpenCompany\Integrations\Lob;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LobService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.lob.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List letters (paginated).
     *
     * @param  int  $limit  Number of results per page (default: 10, max: 100).
     * @param  int  $offset  Number of results to skip (default: 0).
     * @return array Paginated list of letter objects.
     */
    public function listLetters(int $limit = 10, int $offset = 0): array
    {
        return $this->request('GET', '/v1/letters', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a letter by ID.
     *
     * @param  string  $id  The letter ID (e.g., "ltr_...").
     * @return array The letter object.
     */
    public function getLetter(string $id): array
    {
        return $this->request('GET', '/v1/letters/' . urlencode($id));
    }

    /**
     * Create (send) a letter.
     *
     * @param  string|array  $to  Recipient address ID or address object.
     * @param  string|array|null  $from  Sender address ID or address object.
     * @param  string  $file  HTML string or template ID for the letter content.
     * @param  string|null  $description  Optional internal description for the letter.
     * @param  bool  $color  Whether to print in color (default: true).
     * @param  bool  $doubleSided  Whether to print double-sided (default: true).
     * @return array The created letter object.
     */
    public function createLetter(
        string|array $to,
        string|array|null $from,
        string $file,
        ?string $description = null,
        bool $color = true,
        bool $doubleSided = true,
    ): array {
        $data = [
            'to' => $to,
            'file' => $file,
            'color' => $color,
            'double_sided' => $doubleSided,
        ];

        if ($from !== null) {
            $data['from'] = $from;
        }

        if ($description !== null) {
            $data['description'] = $description;
        }

        return $this->request('POST', '/v1/letters', $data);
    }

    /**
     * List postcards (paginated).
     *
     * @param  int  $limit  Number of results per page (default: 10, max: 100).
     * @param  int  $offset  Number of results to skip (default: 0).
     * @return array Paginated list of postcard objects.
     */
    public function listPostcards(int $limit = 10, int $offset = 0): array
    {
        return $this->request('GET', '/v1/postcards', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a postcard by ID.
     *
     * @param  string  $id  The postcard ID (e.g., "psc_...").
     * @return array The postcard object.
     */
    public function getPostcard(string $id): array
    {
        return $this->request('GET', '/v1/postcards/' . urlencode($id));
    }

    /**
     * Create (send) a postcard.
     *
     * @param  string|array  $to  Recipient address ID or address object.
     * @param  string|array|null  $from  Sender address ID or address object.
     * @param  string  $front  HTML string or template ID for the front of the postcard.
     * @param  string  $back  HTML string or template ID for the back of the postcard.
     * @param  string|null  $description  Optional internal description for the postcard.
     * @return array The created postcard object.
     */
    public function createPostcard(
        string|array $to,
        string|array|null $from,
        string $front,
        string $back,
        ?string $description = null,
    ): array {
        $data = [
            'to' => $to,
            'front' => $front,
            'back' => $back,
        ];

        if ($from !== null) {
            $data['from'] = $from;
        }

        if ($description !== null) {
            $data['description'] = $description;
        }

        return $this->request('POST', '/v1/postcards', $data);
    }

    /**
     * List addresses in the Lob account.
     *
     * @return array Paginated list of address objects.
     */
    public function listAddresses(): array
    {
        return $this->request('GET', '/v1/addresses');
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Lob API using Basic authentication.
     *
     * Lob uses Basic auth where the API key (test or live) is the username
     * and the password is empty.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Lob API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apiKey, '')->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->json('error') ?? $response->body();

                Log::error("Lob API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Lob API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Lob API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Lob API: {$e->getMessage()}");
        }
    }
}
