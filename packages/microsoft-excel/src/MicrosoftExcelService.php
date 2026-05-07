<?php

namespace OpenCompany\Integrations\MicrosoftExcel;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Microsoft Excel workbooks through Microsoft Graph v1.0.
 *
 * Handles bearer authentication, OData query serialization, path expansion,
 * workbook session headers, JSON request bodies, error logging, and response parsing.
 */
class MicrosoftExcelService
{
    /**
     * @param  string  $accessToken  Microsoft Graph OAuth access token.
     * @param  string  $baseUrl  Microsoft Graph base URL, usually https://graph.microsoft.com/v1.0.
     */
    public function __construct(private string $accessToken = '', private string $baseUrl = 'https://graph.microsoft.com/v1.0') { $this->baseUrl = rtrim($this->baseUrl, '/'); }
    public function isConfigured(): bool { return $this->accessToken !== ''; }

    /**
     * Execute a Microsoft Excel workbook request and return decoded response data.
     *
     * @param  array<string, mixed>  $pathParams  Path placeholder values.
     * @param  array<string, mixed>  $query  OData query parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body payload.
     * @return array<string, mixed>|list<mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body);
        if ($response->status() === 202 || $response->status() === 204 || $response->body() === '') { return ['success' => true, 'status' => $response->status()]; }
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('Content-Type')];
    }

    /**
     * Execute the raw HTTP request.
     *
     * @param  array<string, mixed>  $query  OData query parameters.
     * @param  array<string, mixed>  $headers  Additional request headers.
     * @param  array<string, mixed>  $body  Request body payload.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = []): Response
    {
        if (!$this->isConfigured()) { throw new RuntimeException('Microsoft Excel access token is required.'); }
        $method = strtoupper($method);
        $response = Http::withHeaders(array_merge(['Accept' => 'application/json', 'Authorization' => 'Bearer '.$this->accessToken], $headers))->timeout(128)->withHeaders(['Content-Type' => 'application/json'])->send($method, $this->urlWithQuery($this->baseUrl.$path, $query), $body === [] ? [] : ['json' => $body]);
        if (!$response->successful()) {
            Log::error('Microsoft Excel Graph request failed', ['method' => $method, 'path' => $path, 'status' => $response->status(), 'body' => $response->body()]);
            $message = $response->json('error.message') ?? $response->json('message') ?? $response->body() ?: 'Microsoft Excel request failed.';
            throw new RuntimeException('Microsoft Excel API error: '.(is_string($message) ? $message : json_encode($message)));
        }
        return $response;
    }

    /** @param  array<string, mixed>  $pathParams  Path placeholder values. */
    private function expandPath(string $pathTemplate, array $pathParams): string { foreach ($pathParams as $key => $value) { $pathTemplate = str_replace('{'.$key.'}', rawurlencode((string) $value), $pathTemplate); } return $pathTemplate; }
    /** @param  array<string, mixed>  $query  Query parameters. */
    private function urlWithQuery(string $url, array $query): string { $parts = []; foreach ($query as $key => $value) { if ($value === null || $value === '') { continue; } if (is_array($value)) { $parts[] = rawurlencode((string) $key).'='.rawurlencode(implode(',', array_map(static fn (mixed $item): string => is_scalar($item) ? (string) $item : json_encode($item), $value))); continue; } $parts[] = rawurlencode((string) $key).'='.rawurlencode(is_bool($value) ? ($value ? 'true' : 'false') : (string) $value); } return $parts === [] ? $url : $url.'?'.implode('&', $parts); }
}
