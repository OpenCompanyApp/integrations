<?php

namespace OpenCompany\Integrations\SurveyMonkey;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SurveyMonkeyService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.surveymonkey.com/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the currently authenticated user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * List surveys.
     */
    public function listSurveys(int $page = 1, int $perPage = 50): array
    {
        return $this->request('GET', '/surveys', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a survey by ID.
     */
    public function getSurvey(string $surveyId): array
    {
        return $this->request('GET', '/surveys/' . urlencode($surveyId));
    }

    /**
     * Create a new survey.
     */
    public function createSurvey(string $title): array
    {
        return $this->request('POST', '/surveys', [
            'title' => $title,
        ]);
    }

    /**
     * List bulk responses for a survey.
     */
    public function listResponses(string $surveyId, int $page = 1, int $perPage = 50): array
    {
        return $this->request('GET', '/surveys/' . urlencode($surveyId) . '/responses/bulk', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a single response for a survey.
     */
    public function getResponse(string $surveyId, string $responseId): array
    {
        return $this->request('GET', '/surveys/' . urlencode($surveyId) . '/responses/' . urlencode($responseId));
    }

    /**
     * List collectors for a survey.
     */
    public function listCollectors(string $surveyId): array
    {
        return $this->request('GET', '/surveys/' . urlencode($surveyId) . '/collectors');
    }

    /**
     * Create a collector for a survey.
     */
    public function createCollector(string $surveyId, string $type, ?string $name = null): array
    {
        $data = ['type' => $type];
        if ($name !== null) {
            $data['name'] = $name;
        }

        return $this->request('POST', '/surveys/' . urlencode($surveyId) . '/collectors', $data);
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
     * Make a raw HTTP request to the SurveyMonkey API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('SurveyMonkey access token is not configured.');
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("SurveyMonkey API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("SurveyMonkey API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("SurveyMonkey API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("SurveyMonkey API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("SurveyMonkey API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to SurveyMonkey API: {$e->getMessage()}");
        }
    }
}
