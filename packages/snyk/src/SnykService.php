<?php

namespace OpenCompany\Integrations\Snyk;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Snyk REST API.
 *
 * Handles token authentication, default API versioning, path and query
 * construction, JSON:API request dispatch, response parsing, and errors.
 */
class SnykService
{
    /**
     * @param  string  $apiToken  Snyk API token.
     * @param  string  $baseUrl  Snyk REST API base URL for the selected region.
     * @param  string  $apiVersion  Default Snyk REST API version query value.
     */
    public function __construct(private string $apiToken = '', private string $baseUrl = 'https://api.snyk.io/rest', private string $apiVersion = '2024-10-15') { $this->baseUrl = rtrim($this->baseUrl, '/'); }
    public function isConfigured(): bool { return $this->apiToken !== ''; }
    /** @param  array<string, mixed>  $pathParams  Path parameters. @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  JSON body. @return array<string, mixed> */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = []): array
    {
        if (!array_key_exists('version', $query) || $query['version'] === null || $query['version'] === '') $query['version'] = $this->apiVersion;
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body);
        if ($response->body() === '') return ['success' => true, 'status' => $response->status()];
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }
    /** @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  JSON body. */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = []): Response
    {
        if (!$this->isConfigured()) throw new RuntimeException('Snyk API token is not configured.');
        try { $method = strtoupper($method); $url = $this->urlWithQuery($this->baseUrl.$path, $query); $http = Http::withHeaders(array_merge(['Authorization'=>'token '.$this->apiToken,'Content-Type'=>'application/vnd.api+json','Accept'=>'application/vnd.api+json'], $headers))->timeout(120); $response = match ($method) { 'GET'=>$http->get($url), 'POST'=>$http->post($url,$body), 'PUT'=>$http->put($url,$body), 'PATCH'=>$http->patch($url,$body), 'DELETE'=>$http->delete($url,$body), default=>throw new RuntimeException("Unsupported HTTP method: {$method}"), }; if (!$response->successful()) { $error = $response->json('errors.0.detail') ?? $response->json('message') ?? $response->json('error') ?? $response->body(); Log::error("Snyk API error: {$method} {$path}", ['status'=>$response->status(),'error'=>$error]); throw new RuntimeException('Snyk API error ('.$response->status().'): '.(is_string($error)?$error:json_encode($error))); } return $response; } catch (\Illuminate\Http\Client\ConnectionException $e) { Log::error("Snyk API connection error: {$method} {$path}", ['error'=>$e->getMessage()]); throw new RuntimeException("Failed to connect to Snyk API: {$e->getMessage()}"); }
    }
    /** @param  array<string, mixed>  $pathParams  Path parameters. */ private function expandPath(string $template, array $pathParams): string { return (string) preg_replace_callback('/\{([A-Za-z0-9_]+)\}/', function(array $m) use ($pathParams): string { $key=$m[1]; if(!array_key_exists($key,$pathParams)||$pathParams[$key]===null||$pathParams[$key]==='') throw new RuntimeException($key.' must be a non-empty path parameter.'); return rawurlencode((string)$pathParams[$key]); }, $template); }
    /** @param  array<string, mixed>  $query  Query parameters. */ private function urlWithQuery(string $url, array $query): string { $parts=[]; foreach($query as $key=>$value){ if($value===null||$value==='')continue; foreach(is_array($value)?$value:[$value] as $item){ if($item===null||$item==='')continue; $encodedValue=is_bool($item)?($item?'true':'false'):(string)$item; $parts[]=rawurlencode((string)$key).'='.rawurlencode($encodedValue); }} return $parts===[]?$url:$url.'?'.implode('&',$parts); }
}