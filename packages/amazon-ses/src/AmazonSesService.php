<?php

namespace OpenCompany\Integrations\AmazonSes;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Amazon SES v2 REST API.
 *
 * Signs every request with AWS Signature Version 4 and exposes both typed SES
 * helpers and generic signed API methods for broader SES v2 coverage.
 */
class AmazonSesService
{
    /**
     * @param  string  $accessKeyId  AWS access key ID.
     * @param  string  $secretAccessKey  AWS secret access key.
     * @param  string  $region  AWS region, for example us-east-1.
     * @param  string  $sessionToken  Optional temporary credentials session token.
     * @param  string  $baseUrl  SES regional endpoint.
     */
    public function __construct(
        private string $accessKeyId = '',
        private string $secretAccessKey = '',
        private string $region = 'us-east-1',
        private string $sessionToken = '',
        private string $baseUrl = '',
    ) {
        $this->region = $this->region ?: 'us-east-1';
        $this->baseUrl = rtrim($this->baseUrl ?: "https://email.{$this->region}.amazonaws.com", '/');
    }

    /**
     * Check whether AWS credentials are available.
     */
    public function isConfigured(): bool
    {
        return $this->accessKeyId !== '' && $this->secretAccessKey !== '';
    }

    /**
     * Send an email via the Amazon SES v2 API.
     *
     * @param  array<string, mixed>  $body  Outbound email payload.
     * @return array<string, mixed>
     */
    public function sendEmail(array $body): array
    {
        return $this->apiPost('/v2/email/outbound-emails', $body);
    }

    /**
     * Get an email template by name.
     *
     * @param  string  $name  Template name.
     * @return array<string, mixed>
     */
    public function getTemplate(string $name): array
    {
        return $this->apiGet('/v2/email/templates/'.rawurlencode($name));
    }

    /**
     * List email templates.
     *
     * @param  int|null  $pageSize  Maximum templates to return.
     * @param  string|null  $nextToken  Pagination token.
     * @return array<string, mixed>
     */
    public function listTemplates(?int $pageSize = null, ?string $nextToken = null): array
    {
        return $this->apiGet('/v2/email/templates', array_filter([
            'PageSize' => $pageSize,
            'NextToken' => $nextToken,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Create a new email template.
     *
     * @param  array<string, mixed>  $body  Template definition.
     * @return array<string, mixed>
     */
    public function createTemplate(array $body): array
    {
        return $this->apiPost('/v2/email/templates', $body);
    }

    /**
     * Update an existing email template.
     *
     * @param  string  $name  Template name.
     * @param  array<string, mixed>  $body  Template content.
     * @return array<string, mixed>
     */
    public function updateTemplate(string $name, array $body): array
    {
        return $this->apiPut('/v2/email/templates/'.rawurlencode($name), $body);
    }

    /**
     * Delete an email template.
     *
     * @param  string  $name  Template name.
     * @return array<string, mixed>
     */
    public function deleteTemplate(string $name): array
    {
        return $this->apiDelete('/v2/email/templates/'.rawurlencode($name));
    }

    /**
     * List account-level suppressed email destinations.
     *
     * @param  int|null  $pageSize  Maximum results to return.
     * @param  string|null  $nextToken  Pagination token.
     * @param  string|null  $reason  Optional suppression reason.
     * @return array<string, mixed>
     */
    public function listSuppressions(?int $pageSize = null, ?string $nextToken = null, ?string $reason = null): array
    {
        return $this->apiGet('/v2/email/suppression/addresses', array_filter([
            'PageSize' => $pageSize,
            'NextToken' => $nextToken,
            'Reasons' => $reason,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * List verified identities.
     *
     * @param  int|null  $pageSize  Maximum results to return.
     * @param  string|null  $nextToken  Pagination token.
     * @return array<string, mixed>
     */
    public function listIdentities(?int $pageSize = null, ?string $nextToken = null): array
    {
        return $this->apiGet('/v2/email/identities', array_filter([
            'PageSize' => $pageSize,
            'NextToken' => $nextToken,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Get details for one verified identity.
     *
     * @param  string  $identity  Email address or domain identity.
     * @return array<string, mixed>
     */
    public function getIdentity(string $identity): array
    {
        return $this->apiGet('/v2/email/identities/'.rawurlencode($identity));
    }

    /**
     * List configuration sets.
     *
     * @param  int|null  $pageSize  Maximum results to return.
     * @param  string|null  $nextToken  Pagination token.
     * @return array<string, mixed>
     */
    public function listConfigurationSets(?int $pageSize = null, ?string $nextToken = null): array
    {
        return $this->apiGet('/v2/email/configuration-sets', array_filter([
            'PageSize' => $pageSize,
            'NextToken' => $nextToken,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Get account-level SES sending details.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->apiGet('/v2/email/account');
    }

    /**
     * Call any signed SES GET endpoint.
     *
     * @param  string  $path  SES API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Call any signed SES POST endpoint.
     *
     * @param  string  $path  SES API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $this->normalizePath($path), body: $body);
    }

    /**
     * Call any signed SES PUT endpoint.
     *
     * @param  string  $path  SES API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), body: $body);
    }

    /**
     * Call any signed SES DELETE endpoint.
     *
     * @param  string  $path  SES API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), body: $body);
    }

    /**
     * Make a signed request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  SES API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Make a signed raw HTTP request.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  SES API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Amazon SES AWS access key ID and secret access key are not configured.');
        }

        $method = strtoupper($method);
        $payload = $body === [] ? '' : json_encode($body, JSON_UNESCAPED_SLASHES);
        $payload = $payload === false ? '' : $payload;
        $headers = $this->signatureHeaders($method, $path, $query, $payload);
        $url = $this->baseUrl.$path.($query === [] ? '' : '?'.$this->canonicalQuery($query));

        try {
            $http = Http::withHeaders($headers)->timeout(30);

            $response = match ($method) {
                'GET' => $http->get($url),
                'POST' => $http->withBody($payload, 'application/json')->post($url),
                'PUT' => $http->withBody($payload, 'application/json')->put($url),
                'DELETE' => $http->withBody($payload, 'application/json')->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('__type') ?? $response->json('message') ?? $response->body();

                Log::error("Amazon SES API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Amazon SES API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Amazon SES API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Amazon SES API: {$e->getMessage()}");
        }
    }

    /**
     * Build AWS SigV4 authorization headers.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, string>
     */
    private function signatureHeaders(string $method, string $path, array $query, string $payload): array
    {
        $now = gmdate('Ymd\THis\Z');
        $date = substr($now, 0, 8);
        $host = parse_url($this->baseUrl, PHP_URL_HOST) ?: "email.{$this->region}.amazonaws.com";
        $payloadHash = hash('sha256', $payload);

        $headers = [
            'content-type' => 'application/json',
            'host' => $host,
            'x-amz-content-sha256' => $payloadHash,
            'x-amz-date' => $now,
        ];

        if ($this->sessionToken !== '') {
            $headers['x-amz-security-token'] = $this->sessionToken;
        }

        ksort($headers);

        $canonicalHeaders = '';
        foreach ($headers as $key => $value) {
            $canonicalHeaders .= strtolower($key).':'.trim($value)."\n";
        }

        $signedHeaders = implode(';', array_keys($headers));
        $credentialScope = "{$date}/{$this->region}/ses/aws4_request";
        $canonicalRequest = implode("\n", [
            $method,
            $path,
            $this->canonicalQuery($query),
            $canonicalHeaders,
            $signedHeaders,
            $payloadHash,
        ]);
        $stringToSign = implode("\n", [
            'AWS4-HMAC-SHA256',
            $now,
            $credentialScope,
            hash('sha256', $canonicalRequest),
        ]);
        $signature = hash_hmac('sha256', $stringToSign, $this->signingKey($date));

        $headers['authorization'] = 'AWS4-HMAC-SHA256 Credential='.$this->accessKeyId.'/'.$credentialScope.', SignedHeaders='.$signedHeaders.', Signature='.$signature;

        return $headers;
    }

    /**
     * Build an AWS canonical query string.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function canonicalQuery(array $query): string
    {
        $pairs = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') {
                    continue;
                }

                $pairs[] = [$this->awsEncode((string) $key), $this->awsEncode(is_bool($item) ? ($item ? 'true' : 'false') : (string) $item)];
            }
        }

        usort($pairs, static fn (array $a, array $b): int => $a <=> $b);

        return implode('&', array_map(static fn (array $pair): string => $pair[0].'='.$pair[1], $pairs));
    }

    /**
     * Build the SigV4 signing key.
     */
    private function signingKey(string $date): string
    {
        $kDate = hash_hmac('sha256', $date, 'AWS4'.$this->secretAccessKey, true);
        $kRegion = hash_hmac('sha256', $this->region, $kDate, true);
        $kService = hash_hmac('sha256', 'ses', $kRegion, true);

        return hash_hmac('sha256', 'aws4_request', $kService, true);
    }

    /**
     * Encode a value for AWS canonical query strings.
     */
    private function awsEncode(string $value): string
    {
        return str_replace('%7E', '~', rawurlencode($value));
    }

    /**
     * Normalize a generic SES API path.
     */
    private function normalizePath(string $path): string
    {
        $path = '/'.ltrim($path, '/');

        if (! str_starts_with($path, '/v2/')) {
            throw new RuntimeException('Amazon SES generic API path must start with /v2/.');
        }

        return $path;
    }
}
