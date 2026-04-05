<?php

namespace OpenCompany\Integrations\Lob;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LobService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.lob.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Send a postcard.
     *
     * @param  string|array  $to  Recipient address ID or address object.
     * @param  string|array|null  $from  Sender address ID or address object (optional for some accounts).
     * @param  string  $front  HTML string or template ID for the front of the postcard.
     * @param  string  $back  HTML string or template ID for the back of the postcard.
     * @param  array  $mergeVariables  Optional merge variables for template interpolation.
     * @return array The created postcard object.
     */
    public function sendPostcard(string|array $to, string|array|null $from, string $front, string $back, array $mergeVariables = []): array
    {
        $data = [
            'to' => $to,
            'front' => $front,
            'back' => $back,
        ];

        if ($from !== null) {
            $data['from'] = $from;
        }

        if (!empty($mergeVariables)) {
            $data['merge_variables'] = $mergeVariables;
        }

        return $this->request('POST', '/postcards', $data);
    }

    /**
     * Send a letter.
     *
     * @param  string|array  $to  Recipient address ID or address object.
     * @param  string|array|null  $from  Sender address ID or address object (optional for some accounts).
     * @param  string  $file  HTML string or template ID for the letter content.
     * @param  bool  $color  Whether to print in color (default: true).
     * @param  bool  $doubleSided  Whether to print double-sided (default: true).
     * @return array The created letter object.
     */
    public function sendLetter(string|array $to, string|array|null $from, string $file, bool $color = true, bool $doubleSided = true): array
    {
        $data = [
            'to' => $to,
            'file' => $file,
            'color' => $color,
            'double_sided' => $doubleSided,
        ];

        if ($from !== null) {
            $data['from'] = $from;
        }

        return $this->request('POST', '/letters', $data);
    }

    /**
     * Get a postcard by ID.
     *
     * @param  string  $id  The postcard ID (e.g., "psc_...").
     * @return array The postcard object.
     */
    public function getPostcard(string $id): array
    {
        return $this->request('GET', '/postcards/' . urlencode($id));
    }

    /**
     * List postcards (paginated).
     *
     * @param  int  $limit  Number of results per page (default: 10, max: 100).
     * @param  string|null  $after  Cursor for pagination — pass the ID from a previous response.
     * @param  array  $filters  Optional filters (e.g., metadata, size, etc.).
     * @return array Paginated list of postcard objects.
     */
    public function listPostcards(int $limit = 10, ?string $after = null, array $filters = []): array
    {
        $params = array_merge(['limit' => $limit], $filters);
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/postcards', $params);
    }

    /**
     * Verify a US address.
     *
     * @param  string  $address  Primary address line (street number, street name, etc.).
     * @param  string  $city  City name.
     * @param  string  $state  Two-letter state code (e.g., "CA").
     * @param  string  $zip  ZIP code (5-digit or ZIP+4).
     * @return array The verification result with deliverability status and normalized address.
     */
    public function verifyAddress(string $address, string $city, string $state, string $zip): array
    {
        return $this->request('POST', '/us_verifications', [
            'primary_line' => $address,
            'city' => $city,
            'state' => $state,
            'zip_code' => $zip,
        ]);
    }

    /**
     * Get the current authenticated user / account info.
     *
     * @return array The user object.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
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
     * Make a raw HTTP request to the Lob API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Lob API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

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
