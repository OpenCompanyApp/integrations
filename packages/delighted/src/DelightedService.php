<?php

namespace OpenCompany\Integrations\Delighted;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Delighted REST API.
 *
 * Handles Basic authentication, documented endpoint mapping, path parameter
 * interpolation, JSON response parsing, and normalized API errors.
 */
class DelightedService
{
    private const DEFAULT_BASE_URL = 'https://api.delighted.com';

    private const OPERATIONS = [
        'send_person' => ['POST', '/v1/people.json'],
        'list_survey_responses' => ['GET', '/v1/survey_responses.json'],
        'get_metrics' => ['GET', '/v1/metrics.json'],
        'create_survey_response' => ['POST', '/v1/survey_responses.json'],
        'delete_pending_survey_request' => ['DELETE', '/v1/people/{person_identifier}/survey_requests/pending.json'],
        'unsubscribe_person' => ['POST', '/v1/unsubscribes.json'],
        'list_people' => ['GET', '/v1/people.json'],
        'list_unsubscribes' => ['GET', '/v1/unsubscribes.json'],
        'list_bounces' => ['GET', '/v1/bounces.json'],
        'delete_person' => ['DELETE', '/v1/people/{person_identifier}'],
        'get_autopilot_email' => ['GET', '/v1/autopilot/email.json'],
        'get_autopilot_sms' => ['GET', '/v1/autopilot/sms.json'],
        'list_autopilot_email_memberships' => ['GET', '/v1/autopilot/email/memberships.json'],
        'list_autopilot_sms_memberships' => ['GET', '/v1/autopilot/sms/memberships.json'],
        'add_autopilot_email_membership' => ['POST', '/v1/autopilot/email/memberships.json'],
        'add_autopilot_sms_membership' => ['POST', '/v1/autopilot/sms/memberships.json'],
        'remove_autopilot_email_membership' => ['DELETE', '/v1/autopilot/email/memberships.json'],
        'remove_autopilot_sms_membership' => ['DELETE', '/v1/autopilot/sms/memberships.json'],
    ];

    /**
     * @param  string  $apiKey  Delighted private API key.
     * @param  string  $baseUrl  Delighted API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Return the documented Delighted operation map.
     *
     * @return array<string, array{0: string, 1: string}>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Call a documented Delighted operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path, query, or JSON body parameters.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported Delighted operation: {$operation}");
        }

        [$method, $path] = $definition;

        return $this->request($method, $this->interpolatePath($path, $params), $params);
    }

    /**
     * Execute a safe raw GET request.
     *
     * @param  string  $path  Relative Delighted API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  string  $path  Relative Delighted API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  string  $path  Relative Delighted API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch an authenticated HTTP request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Delighted API key is required.');
        }

        $response = $this->rawRequest($method, $path, $data);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->withBasicAuth($this->apiKey, '')
            ->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Delighted method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Delighted API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Delighted API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Delighted API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Delighted API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Delighted API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Delighted responses.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '') {
            return ['success' => true];
        }

        $json = $response->json();
        if (is_array($json)) {
            return array_is_list($json) ? ['items' => $json] : $json;
        }

        return ['value' => $body];
    }

    /**
     * Interpolate path variables and remove them from request data.
     *
     * @param  array<string, mixed>  $params  Request data.
     */
    private function interpolatePath(string $path, array &$params): string
    {
        return preg_replace_callback('/\{([^}]+)\}/', function (array $matches) use (&$params): string {
            $key = $matches[1];
            $value = $params[$key] ?? null;
            if ($value === null || $value === '') {
                throw new RuntimeException($key.' is required.');
            }

            unset($params[$key]);

            return rawurlencode((string) $value);
        }, $path) ?? $path;
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Delighted API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
