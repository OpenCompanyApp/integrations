<?php

namespace OpenCompany\Integrations\Rootly;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Rootly API.
 *
 * Handles bearer token authentication, JSON:API headers, path and query
 * construction, request dispatch, response parsing, and API error normalization.
 */
class RootlyService
{
    /**
     * @param  string  $apiToken  Rootly API token.
     * @param  string  $baseUrl  Rootly API base URL.
     */
    public function __construct(private string $apiToken = '', private string $baseUrl = 'https://api.rootly.com') { $this->baseUrl = rtrim($this->baseUrl, '/'); }
    public function isConfigured(): bool { return $this->apiToken !== ''; }
    /** @param  array<string, mixed>  $pathParams  Path parameters. @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  JSON body. @return array<string, mixed> */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body);
        if ($response->body() === '') return ['success' => true, 'status' => $response->status()];
        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }
    /** @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  JSON body. */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = []): Response
    {
        if (!$this->isConfigured()) throw new RuntimeException('Rootly API token is not configured.');
        try { $method = strtoupper($method); $url = $this->urlWithQuery($this->baseUrl.$path, $query); $http = Http::withHeaders(array_merge(['Authorization'=>'Bearer '.$this->apiToken,'Content-Type'=>'application/vnd.api+json','Accept'=>'application/vnd.api+json'], $headers))->timeout(120); $response = match ($method) { 'GET'=>$http->get($url), 'POST'=>$http->post($url,$body), 'PUT'=>$http->put($url,$body), 'PATCH'=>$http->patch($url,$body), 'DELETE'=>$http->delete($url,$body), default=>throw new RuntimeException("Unsupported HTTP method: {$method}"), }; if (!$response->successful()) { $error = $response->json('message') ?? $response->json('error') ?? $response->json('errors') ?? $response->body(); Log::error("Rootly API error: {$method} {$path}", ['status'=>$response->status(),'error'=>$error]); throw new RuntimeException('Rootly API error ('.$response->status().'): '.(is_string($error)?$error:json_encode($error))); } return $response; } catch (\Illuminate\Http\Client\ConnectionException $e) { Log::error("Rootly API connection error: {$method} {$path}", ['error'=>$e->getMessage()]); throw new RuntimeException("Failed to connect to Rootly API: {$e->getMessage()}"); }
    }
    /** @param  array<string, mixed>  $pathParams  Path parameters. */ private function expandPath(string $template, array $pathParams): string { return (string) preg_replace_callback('/\{([^}]+)\}/', function(array $m) use ($pathParams): string { $key=ltrim($m[1], '+'); if(!array_key_exists($key,$pathParams)||$pathParams[$key]===null||$pathParams[$key]==='') throw new RuntimeException($key.' must be a non-empty path parameter.'); return rawurlencode((string)$pathParams[$key]); }, $template); }
    /** @param  array<string, mixed>  $query  Query parameters. */ private function urlWithQuery(string $url, array $query): string { $parts=[]; foreach($query as $key=>$value){ if($value===null||$value==='')continue; foreach(is_array($value)?$value:[$value] as $item){ if($item===null||$item==='')continue; $encodedValue=is_bool($item)?($item?'true':'false'):(string)$item; $parts[]=rawurlencode((string)$key).'='.rawurlencode($encodedValue); }} return $parts===[]?$url:$url.'?'.implode('&',$parts); }
}