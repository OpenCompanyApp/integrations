<?php

namespace OpenCompany\Integrations\Logto;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Logto Management API.
 *
 * Handles direct access tokens or client-credentials token exchange, request
 * dispatch, path/query/header construction, and Logto API error handling.
 */
class LogtoService
{
    private ?string $cachedAccessToken = null;

    /** @param  string  $clientId  Logto machine-to-machine application id. @param  string  $clientSecret  Logto machine-to-machine application secret. @param  string  $accessToken  Optional pre-issued Management API access token. @param  string  $baseUrl  Logto tenant base URL. @param  string  $tokenUrl  Optional token endpoint override. */
    public function __construct(private string $clientId = '', private string $clientSecret = '', private string $accessToken = '', private string $baseUrl = 'https://tenant.logto.app', private string $tokenUrl = '', private string $resource = '', private string $scope = 'all') { $this->baseUrl = rtrim($this->baseUrl, '/'); $this->tokenUrl = $this->tokenUrl !== '' ? $this->tokenUrl : $this->baseUrl.'/oidc/token'; $this->resource = $this->resource !== '' ? $this->resource : $this->baseUrl.'/api'; }
    public function isConfigured(): bool { return $this->accessToken !== '' || ($this->clientId !== '' && $this->clientSecret !== ''); }
    /** @return array<string, array<string, mixed>> */ public static function operations(): array { return LogtoOperations::all(); }
    /** @param  array<string, mixed>  $operation  Operation metadata. @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */
    public function executeOperation(array $operation, array $args = []): array
    {
        $body = array_key_exists('body', $args) ? $args['body'] : null;
        if (($operation['body_required'] ?? false) && ($body === null || $body === '' || $body === [])) { throw new RuntimeException('body must be a non-empty object matching the Logto OpenAPI request schema.'); }
        return $this->request((string)$operation['method'], (string)$operation['path'], $this->mapped($args, $operation['path_params'] ?? [], true), $this->mapped($args, $operation['query_params'] ?? []), $this->mapped($args, $operation['header_params'] ?? []), $body, $operation['content_type'] ?? null);
    }
    /** @param  array<string, mixed>  $pathParams  Path parameters. @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @return array<string, mixed> */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], mixed $body = null, ?string $contentType = null): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body, $contentType);
        if ($response->status() === 204 || $response->body() === '') { return ['success' => true, 'status' => $response->status()]; }
        $type = (string)$response->header('Content-Type');
        if (! str_contains($type, 'json')) { return ['body' => $response->body(), 'content_type' => $type, 'status' => $response->status()]; }
        return $response->json() ?? [];
    }
    private function token(): string
    {
        if ($this->accessToken !== '') { return $this->accessToken; }
        if ($this->cachedAccessToken !== null) { return $this->cachedAccessToken; }
        if ($this->clientId === '' || $this->clientSecret === '') { throw new RuntimeException('Logto client id and client secret are required when access token is not provided.'); }
        try { $response = Http::asForm()->timeout(30)->post($this->tokenUrl, ['grant_type'=>'client_credentials','client_id'=>$this->clientId,'client_secret'=>$this->clientSecret,'resource'=>$this->resource,'scope'=>$this->scope]); } catch (\Illuminate\Http\Client\ConnectionException $e) { throw new RuntimeException('Failed to connect to Logto token endpoint: '.$e->getMessage()); }
        if (! $response->successful()) { throw new RuntimeException('Logto token endpoint returned HTTP '.$response->status().'.'); }
        $token = (string)($response->json('access_token') ?? '');
        if ($token === '') { throw new RuntimeException('Logto token endpoint did not return access_token.'); }
        return $this->cachedAccessToken = $token;
    }
    /** @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], mixed $body = null, ?string $contentType = null): Response
    {
        if (! $this->isConfigured()) { throw new RuntimeException('Logto integration is not configured.'); }
        $method = strtoupper($method); $url = $this->urlWithQuery($this->baseUrl.$path, $query);
        try { $http = Http::withHeaders(array_merge(['Authorization' => 'Bearer '.$this->token(), 'Accept' => 'application/json'], $headers))->timeout(120); if ($body !== null) { if (is_array($body) && is_string($contentType) && str_contains($contentType, 'application/x-www-form-urlencoded')) { $response = match($method){'POST'=>$http->asForm()->post($url,$body),'PUT'=>$http->asForm()->put($url,$body),'PATCH'=>$http->asForm()->patch($url,$body),default=>$http->asForm()->send($method,$url,['form_params'=>$body])}; } elseif (is_array($body)) { $response = $http->withHeaders(['Content-Type' => $contentType ?: 'application/json'])->send($method, $url, ['json' => $body]); } else { $response = $http->withBody((string)$body, $contentType ?: 'application/octet-stream')->send($method, $url); } } else { $response = match($method){'GET'=>$http->get($url),'POST'=>$http->post($url,[]),'PUT'=>$http->put($url,[]),'PATCH'=>$http->patch($url,[]),'DELETE'=>$http->delete($url,[]),default=>$http->send($method,$url)}; } } catch (\Illuminate\Http\Client\ConnectionException $e) { Log::error("Logto API connection error: {$method} {$path}", ['error'=>$e->getMessage()]); throw new RuntimeException('Failed to connect to Logto API: '.$e->getMessage()); }
        if (! $response->successful()) { $error = $response->json('message') ?? $response->json('error') ?? $response->body(); Log::error("Logto API error: {$method} {$path}", ['status'=>$response->status(),'error'=>$error]); throw new RuntimeException('Logto API error ('.$response->status().'): '.(is_string($error)?$error:json_encode($error))); }
        return $response;
    }
    /** @param  array<string, mixed>  $args  Tool arguments. @param  array<string, string>  $map  Official name to argument key map. @return array<string, mixed> */ private function mapped(array $args, array $map, bool $required=false): array { $out=[]; foreach($map as $official=>$key){ if(!array_key_exists($key,$args)||$args[$key]===null||$args[$key]===''){ if($required) throw new RuntimeException($key.' must be a non-empty parameter.'); continue;} $out[$official]=$args[$key]; } return $out; }
    /** @param  array<string, mixed>  $pathParams  Path parameters. */ private function expandPath(string $template, array $pathParams): string { return (string)preg_replace_callback('/\{([^}]+)\}/', function(array $m) use($pathParams): string { $key=$m[1]; if(!array_key_exists($key,$pathParams)||$pathParams[$key]===null||$pathParams[$key]==='') throw new RuntimeException($key.' must be a non-empty path parameter.'); return rawurlencode((string)$pathParams[$key]); }, $template); }
    /** @param  array<string, mixed>  $query  Query parameters. */ private function urlWithQuery(string $url, array $query): string { $parts=[]; foreach($query as $key=>$value){ if($value===null||$value==='')continue; foreach(is_array($value)?$value:[$value] as $item){ if($item===null||$item==='')continue; $parts[]=rawurlencode((string)$key).'='.rawurlencode(is_bool($item)?($item?'true':'false'):(string)$item); }} return $parts===[]?$url:$url.'?'.implode('&',$parts); }
}