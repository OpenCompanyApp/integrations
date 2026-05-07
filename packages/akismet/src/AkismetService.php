<?php

namespace OpenCompany\Integrations\Akismet;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Akismet REST API.
 *
 * Handles API-key and blog parameters, form-encoded requests, text response
 * parsing, JSON usage endpoints, and Akismet debug header normalization.
 */
class AkismetService
{
    private const USER_AGENT = 'OpenCompany Integrations/1.0 | Akismet';

    /**
     * @param  string  $apiKey  Akismet API key.
     * @param  string  $blog  Default front-page URL for Akismet checks.
     * @param  string  $baseUrl  Akismet REST base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $blog = '',
        private string $baseUrl = 'https://rest.akismet.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '' && trim($this->blog) !== '';
    }

    /**
     * Verify the configured or supplied API key and blog URL.
     *
     * @return array<string, mixed>
     */
    public function verifyKey(string $blog = ''): array
    {
        return $this->requestText('/1.1/verify-key', $this->basePayload($blog), 'verify');
    }

    /**
     * Check submitted content for spam.
     *
     * @param  array<string, mixed>  $params  Akismet content and request metadata.
     * @return array<string, mixed>
     */
    public function commentCheck(array $params): array
    {
        $this->requireValue($params, 'user_ip');

        return $this->requestText('/1.1/comment-check', $this->contentPayload($params), 'check');
    }

    /**
     * Submit missed spam feedback to Akismet.
     *
     * @param  array<string, mixed>  $params  Original content metadata.
     * @return array<string, mixed>
     */
    public function submitSpam(array $params): array
    {
        $this->requireValue($params, 'user_ip');

        return $this->requestText('/1.1/submit-spam', $this->contentPayload($params), 'feedback');
    }

    /**
     * Submit false-positive ham feedback to Akismet.
     *
     * @param  array<string, mixed>  $params  Original content metadata.
     * @return array<string, mixed>
     */
    public function submitHam(array $params): array
    {
        $this->requireValue($params, 'user_ip');

        return $this->requestText('/1.1/submit-ham', $this->contentPayload($params), 'feedback');
    }

    /**
     * Retrieve per-site activity for the API key.
     *
     * @param  array<string, mixed>  $params  month, filter, format, order, limit, and offset.
     * @return array<string, mixed>
     */
    public function keySites(array $params = []): array
    {
        $payload = $this->withApiKey($this->only($params, ['month', 'filter', 'format', 'order', 'limit', 'offset']));
        $format = strtolower((string) ($payload['format'] ?? 'json'));

        return $format === 'csv'
            ? $this->requestRaw('/1.2/key-sites', $payload)
            : $this->requestJson('/1.2/key-sites', $payload);
    }

    /**
     * Retrieve API usage and throttling status for the current month.
     *
     * @return array<string, mixed>
     */
    public function usageLimit(): array
    {
        return $this->requestJson('/1.2/usage-limit', ['api_key' => $this->requiredApiKey()]);
    }

    /**
     * POST form data and parse Akismet text responses.
     *
     * @param  array<string, mixed>  $payload  Form payload.
     * @return array<string, mixed>
     */
    private function requestText(string $path, array $payload, string $mode): array
    {
        $response = $this->post($path, $payload);
        $body = trim($response->body());

        if (!$response->successful()) {
            $this->throwResponse($response, $path);
        }

        $debug = $response->header('X-akismet-debug-help');

        return match ($mode) {
            'verify' => ['valid' => $body === 'valid', 'body' => $body, 'debug' => $debug],
            'check' => [
                'spam' => $body === 'true',
                'body' => $body,
                'pro_tip' => $response->header('X-akismet-pro-tip'),
                'recheck_after' => $response->header('X-akismet-recheck-after'),
                'debug' => $debug,
            ],
            default => ['accepted' => $response->successful(), 'body' => $body, 'debug' => $debug],
        };
    }

    /**
     * POST form data and parse a JSON response.
     *
     * @param  array<string, mixed>  $payload  Form payload.
     * @return array<string, mixed>
     */
    private function requestJson(string $path, array $payload): array
    {
        $response = $this->post($path, $payload);

        if (!$response->successful()) {
            $this->throwResponse($response, $path);
        }

        $json = $response->json();

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * POST form data and return raw response text.
     *
     * @param  array<string, mixed>  $payload  Form payload.
     * @return array<string, mixed>
     */
    private function requestRaw(string $path, array $payload): array
    {
        $response = $this->post($path, $payload);

        if (!$response->successful()) {
            $this->throwResponse($response, $path);
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Execute a form-encoded POST request.
     *
     * @param  array<string, mixed>  $payload  Form payload.
     */
    private function post(string $path, array $payload): Response
    {
        try {
            return Http::asForm()
                ->withUserAgent(self::USER_AGENT)
                ->timeout(60)
                ->post($this->baseUrl.$path, array_filter($payload, static fn (mixed $value): bool => $value !== null && $value !== ''));
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Akismet API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Akismet API: '.$e->getMessage());
        }
    }

    private function throwResponse(Response $response, string $path): void
    {
        $message = $response->header('X-akismet-debug-help') ?: trim(strip_tags($response->body()));
        Log::error('Akismet API error: '.$path, ['status' => $response->status(), 'error' => $message]);

        throw new RuntimeException('Akismet API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Build common API key and blog fields.
     *
     * @return array<string, mixed>
     */
    private function basePayload(string $blog = ''): array
    {
        $blog = $blog !== '' ? $blog : $this->blog;
        if ($blog === '') {
            throw new RuntimeException('blog is required.');
        }

        return ['api_key' => $this->requiredApiKey(), 'blog' => $blog];
    }

    /**
     * Build content-check payload with known Akismet fields plus safe passthrough metadata.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @return array<string, mixed>
     */
    private function contentPayload(array $params): array
    {
        $payload = $this->basePayload((string) ($params['blog'] ?? ''));
        foreach ($params as $key => $value) {
            if (in_array($key, ['api_key'], true)) {
                continue;
            }
            if (is_array($value)) {
                foreach ($value as $index => $item) {
                    $payload[$key.'['.$index.']'] = $item;
                }
                continue;
            }
            $payload[$key] = $value;
        }

        return $payload;
    }

    /**
     * Add the API key to a payload.
     *
     * @param  array<string, mixed>  $payload  Request payload.
     * @return array<string, mixed>
     */
    private function withApiKey(array $payload): array
    {
        return ['api_key' => $this->requiredApiKey()] + $payload;
    }

    /**
     * Filter an argument array to allowed keys.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @param  list<string>  $keys  Allowed keys.
     * @return array<string, mixed>
     */
    private function only(array $params, array $keys): array
    {
        return array_intersect_key($params, array_flip($keys));
    }

    private function requiredApiKey(): string
    {
        if (trim($this->apiKey) === '') {
            throw new RuntimeException('Akismet API key is required.');
        }

        return $this->apiKey;
    }

    /**
     * Ensure a required argument is present and non-empty.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     */
    private function requireValue(array $params, string $key): void
    {
        if (($params[$key] ?? '') === '') {
            throw new RuntimeException($key.' is required.');
        }
    }
}
