<?php

namespace OpenCompany\Integrations\GoogleForms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleFormsService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://forms.googleapis.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List forms owned by the authenticated user.
     *
     * @param  int|null  $pageSize  Number of forms to return per page (max 100).
     * @param  string|null  $pageToken  Token for fetching the next page.
     * @param  string|null  $filter  Filter expression (e.g. "creator_email = 'user@example.com'").
     * @return array<string, mixed>
     */
    public function listForms(?int $pageSize = null, ?string $pageToken = null, ?string $filter = null): array
    {
        $params = [];
        if ($pageSize !== null) {
            $params['pageSize'] = $pageSize;
        }
        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }
        if ($filter !== null) {
            $params['filter'] = $filter;
        }

        return $this->request('GET', '/v1/forms', $params);
    }

    /**
     * Get a specific form by ID.
     *
     * @param  string  $formId  The form ID.
     * @return array<string, mixed>
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', '/v1/forms/' . urlencode($formId));
    }

    /**
     * Create a new Google Form.
     *
     * @param  array  $info  The form info object containing form structure.
     * @param  string|null  $title  The title of the form.
     * @param  string|null  $description  The description of the form.
     * @param  string|null  $documentTitle  The document title (shown in Drive).
     * @return array<string, mixed>
     */
    public function createForm(array $info = [], ?string $title = null, ?string $description = null, ?string $documentTitle = null): array
    {
        $body = [];

        if (!empty($info)) {
            $body['info'] = $info;
        }

        if ($title !== null) {
            $body['info']['title'] = $title;
        }
        if ($description !== null) {
            $body['info']['description'] = $description;
        }
        if ($documentTitle !== null) {
            $body['info']['documentTitle'] = $documentTitle;
        }

        return $this->request('POST', '/v1/forms', $body);
    }

    /**
     * List responses for a specific form.
     *
     * @param  string  $formId  The form ID.
     * @param  int|null  $pageSize  Number of responses per page.
     * @param  string|null  $pageToken  Token for fetching the next page.
     * @param  string|null  $filter  Filter expression (e.g. "timestamp >= 1234567890").
     * @return array<string, mixed>
     */
    public function listResponses(string $formId, ?int $pageSize = null, ?string $pageToken = null, ?string $filter = null): array
    {
        $params = [];
        if ($pageSize !== null) {
            $params['pageSize'] = $pageSize;
        }
        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }
        if ($filter !== null) {
            $params['filter'] = $filter;
        }

        return $this->request('GET', '/v1/forms/' . urlencode($formId) . '/responses', $params);
    }

    /**
     * Get a specific form response.
     *
     * @param  string  $formId  The form ID.
     * @param  string  $responseId  The response ID.
     * @return array<string, mixed>
     */
    public function getResponse(string $formId, string $responseId): array
    {
        return $this->request('GET', '/v1/forms/' . urlencode($formId) . '/responses/' . urlencode($responseId));
    }

    /**
     * Submit a response to a form.
     *
     * @param  string  $formId  The form ID.
     * @param  array  $answers  Array of answer objects keyed by question ID.
     * @return array<string, mixed>
     */
    public function createResponse(string $formId, array $answers): array
    {
        $body = [
            'answers' => $answers,
        ];

        return $this->request('POST', '/v1/forms/' . urlencode($formId) . '/responses', $body);
    }

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Google Forms API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array  $data  Query params (GET) or JSON body (POST/PUT).
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Google Forms access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                $json = $response->json();
                $error = $json['error']['message'] ?? $json['error']['status'] ?? $response->body();

                Log::error("Google Forms API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Google Forms API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Forms API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Forms API: {$e->getMessage()}");
        }
    }
}
