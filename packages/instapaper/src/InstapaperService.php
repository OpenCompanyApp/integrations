<?php

namespace OpenCompany\Integrations\Instapaper;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Instapaper Full API and Simple API.
 *
 * Handles OAuth 1.0a request signing, Basic-auth Simple API requests, endpoint
 * mapping, response parsing, and normalized API errors.
 */
class InstapaperService
{
    private const DEFAULT_BASE_URL = 'https://www.instapaper.com';

    private const OPERATIONS = [
        'get_access_token' => ['POST', '/api/1/oauth/access_token', 'consumer'],
        'verify_credentials' => ['POST', '/api/1/account/verify_credentials', 'full'],
        'list_bookmarks' => ['POST', '/api/1/bookmarks/list', 'full'],
        'update_read_progress' => ['POST', '/api/1/bookmarks/update_read_progress', 'full'],
        'add_bookmark' => ['POST', '/api/1/bookmarks/add', 'full'],
        'delete_bookmark' => ['POST', '/api/1/bookmarks/delete', 'full'],
        'star_bookmark' => ['POST', '/api/1/bookmarks/star', 'full'],
        'unstar_bookmark' => ['POST', '/api/1/bookmarks/unstar', 'full'],
        'archive_bookmark' => ['POST', '/api/1/bookmarks/archive', 'full'],
        'unarchive_bookmark' => ['POST', '/api/1/bookmarks/unarchive', 'full'],
        'move_bookmark' => ['POST', '/api/1/bookmarks/move', 'full'],
        'get_bookmark_text' => ['POST', '/api/1/bookmarks/get_text', 'full'],
        'list_folders' => ['POST', '/api/1/folders/list', 'full'],
        'add_folder' => ['POST', '/api/1/folders/add', 'full'],
        'delete_folder' => ['POST', '/api/1/folders/delete', 'full'],
        'set_folder_order' => ['POST', '/api/1/folders/set_order', 'full'],
        'list_highlights' => ['GET', '/api/1.1/bookmarks/{bookmark_id}/highlights', 'full'],
        'create_highlight' => ['POST', '/api/1.1/bookmarks/{bookmark_id}/highlight', 'full'],
        'delete_highlight' => ['DELETE', '/api/1.1/highlights/{highlight_id}/delete', 'full'],
        'simple_authenticate' => ['GET', '/api/authenticate', 'simple'],
        'simple_add_url' => ['POST', '/api/add', 'simple'],
    ];

    /**
     * @param  string  $consumerKey  Instapaper OAuth consumer key.
     * @param  string  $consumerSecret  Instapaper OAuth consumer secret.
     * @param  string  $oauthToken  Instapaper OAuth access token.
     * @param  string  $oauthTokenSecret  Instapaper OAuth access token secret.
     * @param  string  $simpleUsername  Optional Simple API username.
     * @param  string  $simplePassword  Optional Simple API password.
     * @param  string  $baseUrl  Instapaper base URL.
     */
    public function __construct(
        private string $consumerKey = '',
        private string $consumerSecret = '',
        private string $oauthToken = '',
        private string $oauthTokenSecret = '',
        private string $simpleUsername = '',
        private string $simplePassword = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether Full API OAuth credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->consumerKey) !== ''
            && trim($this->consumerSecret) !== ''
            && trim($this->oauthToken) !== ''
            && trim($this->oauthTokenSecret) !== ''
            && trim($this->baseUrl) !== '';
    }

    /**
     * Return the documented Instapaper operation map.
     *
     * @return array<string, array{0: string, 1: string, 2: string}>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Call a documented Instapaper operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path, query, or form parameters.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported Instapaper operation: {$operation}");
        }

        [$method, $path, $authMode] = $definition;
        if ($operation === 'get_access_token') {
            $params['x_auth_mode'] = 'client_auth';
        }

        $path = $this->interpolatePath($path, $params);

        return match ($authMode) {
            'consumer' => $this->oauthRequest($method, $path, $params, false),
            'full' => $this->oauthRequest($method, $path, $params, true),
            'simple' => $this->simpleRequest($method, $path, $params),
            default => throw new RuntimeException("Unsupported Instapaper auth mode: {$authMode}"),
        };
    }

    /**
     * Execute a safe raw Full API POST request.
     *
     * @param  string  $path  Relative Instapaper API path.
     * @param  array<string, mixed>  $payload  Form body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->oauthRequest('POST', $this->normalizePath($path), $payload, true);
    }

    /**
     * Dispatch an OAuth-signed Instapaper Full API request.
     *
     * @param  array<string, mixed>  $data  Query or form parameters.
     * @return array<string, mixed>
     */
    private function oauthRequest(string $method, string $path, array $data = [], bool $requiresToken = true): array
    {
        $this->ensureOAuthConfigured($requiresToken);

        $response = $this->rawOAuthRequest($method, $path, $data, $requiresToken);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Dispatch a Simple API Basic-auth request.
     *
     * @param  array<string, mixed>  $data  Query or form parameters.
     * @return array<string, mixed>
     */
    private function simpleRequest(string $method, string $path, array $data = []): array
    {
        [$username, $password] = $this->simpleCredentials($data);
        $response = $this->rawSimpleRequest($method, $path, $data, $username, $password);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        $decoded = $this->decodeResponse($response);
        $decoded['status'] = $response->status();

        return $decoded;
    }

    /**
     * Make a raw OAuth-signed HTTP request.
     *
     * @param  array<string, mixed>  $data  Query or form parameters.
     */
    private function rawOAuthRequest(string $method, string $path, array $data, bool $requiresToken): Response
    {
        $url = $this->baseUrl.$path;
        $headers = [
            'Authorization' => $this->oauthHeader($method, $url, $data, $requiresToken),
            'Accept' => 'application/json, text/html;q=0.9, */*;q=0.8',
        ];

        $http = Http::asForm()->withHeaders($headers)->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['form_params' => $data]),
                default => throw new RuntimeException("Unsupported Instapaper method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Instapaper API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Instapaper API: '.$e->getMessage());
        }
    }

    /**
     * Make a raw Simple API HTTP request.
     *
     * @param  array<string, mixed>  $data  Query or form parameters.
     */
    private function rawSimpleRequest(string $method, string $path, array $data, string $username, string $password): Response
    {
        $url = $this->baseUrl.$path;
        unset($data['username'], $data['password']);
        $http = Http::asForm()->withBasicAuth($username, $password)->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new RuntimeException("Unsupported Instapaper Simple API method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Instapaper Simple API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Instapaper Simple API: '.$e->getMessage());
        }
    }

    /**
     * Build the OAuth 1.0a Authorization header.
     *
     * @param  array<string, mixed>  $requestParams  Query or form parameters.
     */
    private function oauthHeader(string $method, string $url, array $requestParams, bool $includeToken): string
    {
        $oauth = [
            'oauth_consumer_key' => $this->consumerKey,
            'oauth_nonce' => bin2hex(random_bytes(16)),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => (string) time(),
            'oauth_version' => '1.0',
        ];

        if ($includeToken) {
            $oauth['oauth_token'] = $this->oauthToken;
        }

        $signatureParams = array_merge($this->flattenParams($requestParams), $oauth);
        $oauth['oauth_signature'] = $this->sign($method, $url, $signatureParams, $includeToken ? $this->oauthTokenSecret : '');

        $pairs = [];
        foreach ($oauth as $key => $value) {
            $pairs[] = $this->percentEncode($key).'="'.$this->percentEncode((string) $value).'"';
        }

        return 'OAuth '.implode(', ', $pairs);
    }

    /**
     * Create an HMAC-SHA1 OAuth signature.
     *
     * @param  array<string, string>  $params  Request and OAuth parameters.
     */
    private function sign(string $method, string $url, array $params, string $tokenSecret): string
    {
        ksort($params);
        $pairs = [];
        foreach ($params as $key => $value) {
            $pairs[] = $this->percentEncode($key).'='.$this->percentEncode($value);
        }

        $base = strtoupper($method).'&'.$this->percentEncode($url).'&'.$this->percentEncode(implode('&', $pairs));
        $key = $this->percentEncode($this->consumerSecret).'&'.$this->percentEncode($tokenSecret);

        return base64_encode(hash_hmac('sha1', $base, $key, true));
    }

    /**
     * Flatten scalar request params for OAuth signatures.
     *
     * @param  array<string, mixed>  $params  Request parameters.
     * @return array<string, string>
     */
    private function flattenParams(array $params): array
    {
        $flattened = [];
        foreach ($params as $key => $value) {
            if (is_bool($value)) {
                $flattened[$key] = $value ? 'true' : 'false';
            } elseif (is_scalar($value) || $value === null) {
                $flattened[$key] = (string) $value;
            } else {
                $flattened[$key] = json_encode($value, JSON_UNESCAPED_SLASHES) ?: '';
            }
        }

        return $flattened;
    }

    private function percentEncode(string $value): string
    {
        return str_replace('%7E', '~', rawurlencode($value));
    }

    /**
     * Ensure OAuth credentials required for a request are present.
     */
    private function ensureOAuthConfigured(bool $requiresToken): void
    {
        if (trim($this->consumerKey) === '' || trim($this->consumerSecret) === '') {
            throw new RuntimeException('Instapaper consumer key and consumer secret are required.');
        }

        if ($requiresToken && (trim($this->oauthToken) === '' || trim($this->oauthTokenSecret) === '')) {
            throw new RuntimeException('Instapaper OAuth token and token secret are required.');
        }
    }

    /**
     * Resolve Simple API credentials from arguments or configured defaults.
     *
     * @param  array<string, mixed>  $data  Tool arguments.
     * @return array{0: string, 1: string}
     */
    private function simpleCredentials(array $data): array
    {
        $username = (string) ($data['username'] ?? $this->simpleUsername);
        $password = (string) ($data['password'] ?? $this->simplePassword);
        if ($username === '' || $password === '') {
            throw new RuntimeException('Instapaper Simple API username and password are required.');
        }

        return [$username, $password];
    }

    /**
     * Throw a normalized Instapaper API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $parsed = $this->decodeResponse($response);
        $message = (string) ($parsed['message'] ?? $parsed['error'] ?? $parsed['value'] ?? '');
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Instapaper API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Instapaper API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, qline, text, HTML, or empty Instapaper responses.
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
            return $json;
        }

        if (!str_starts_with(ltrim($body), '<') && str_contains($body, '=')) {
            parse_str($body, $parsed);
            if (is_array($parsed) && $parsed !== []) {
                return $parsed;
            }
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
            throw new RuntimeException('Instapaper API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
