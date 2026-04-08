<?php

namespace OpenCompany\Integrations\Recaptcha;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaService
{
    public function __construct(
        private string $baseUrl = 'https://recaptchaenterprise.googleapis.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * List assessments for a project.
     *
     * @see https://cloud.google.com/recaptcha-enterprise/docs/reference/rest/v1/projects.assessments/list
     */
    public function listAssessments(string $parent, int $pageSize = 50, string $pageToken = ''): array
    {
        $query = array_filter(['pageSize' => $pageSize, 'pageToken' => $pageToken]);

        return $this->request('GET', "/{$parent}/assessments", $query);
    }

    /**
     * Get a single assessment by name.
     *
     * @see https://cloud.google.com/recaptcha-enterprise/docs/reference/rest/v1/projects.assessments/get
     */
    public function getAssessment(string $name): array
    {
        return $this->request('GET', "/{$name}");
    }

    /**
     * Create a new assessment to evaluate a reCAPTCHA token.
     *
     * @see https://cloud.google.com/recaptcha-enterprise/docs/reference/rest/v1/projects.assessments/create
     */
    public function createAssessment(string $parent, array $payload): array
    {
        return $this->request('POST', "/{$parent}/assessments", [], $payload);
    }

    /**
     * List keys for a project.
     *
     * @see https://cloud.google.com/recaptcha-enterprise/docs/reference/rest/v1/projects.keys/list
     */
    public function listKeys(string $parent, int $pageSize = 50, string $pageToken = ''): array
    {
        $query = array_filter(['pageSize' => $pageSize, 'pageToken' => $pageToken]);

        return $this->request('GET', "/{$parent}/keys", $query);
    }

    /**
     * Get a single key by name.
     *
     * @see https://cloud.google.com/recaptcha-enterprise/docs/reference/rest/v1/projects.keys/get
     */
    public function getKey(string $name): array
    {
        return $this->request('GET', "/{$name}");
    }

    /**
     * List annotations for an assessment.
     *
     * @see https://cloud.google.com/recaptcha-enterprise/docs/reference/rest/v1/projects.assessments.annotations/list
     */
    public function listAnnotations(string $parent, int $pageSize = 50, string $pageToken = ''): array
    {
        $query = array_filter(['pageSize' => $pageSize, 'pageToken' => $pageToken]);

        return $this->request('GET', "/{$parent}/annotations", $query);
    }

    /**
     * Get info about the current API service status / caller identity.
     *
     * Uses a simple endpoint to verify connectivity.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Make an HTTP request to the reCAPTCHA Enterprise API.
     */
    private function request(string $method, string $path, array $query = [], ?array $body = null): array
    {
        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, array_filter($query, fn ($v) => $v !== '' && $v !== null)),
                'POST' => $http->post($url, $body),
                default => throw new \InvalidArgumentException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error.message')
                    ?? $response->json('error.status')
                    ?? $response->body();

                Log::error("reCAPTCHA Enterprise API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                throw new \RuntimeException(
                    'reCAPTCHA Enterprise API error (' . $response->status() . '): '
                    . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("reCAPTCHA Enterprise API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('reCAPTCHA Enterprise API connection error: ' . $e->getMessage());
        }
    }
}
