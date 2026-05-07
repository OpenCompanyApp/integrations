<?php

namespace OpenCompany\Integrations\StatusCake;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the StatusCake API.
 *
 * Handles bearer-token authentication, path/query construction, form-encoded
 * request dispatch, response parsing, and StatusCake API error normalization.
 */
class StatusCakeService
{
    /**
     * @param  string  $apiKey  StatusCake API key for bearer authentication.
     * @param  string  $baseUrl  StatusCake API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.statuscake.com/v1') { $this->baseUrl = rtrim($this->baseUrl, '/'); }
    public function isConfigured(): bool { return $this->apiKey !== '' && $this->baseUrl !== ''; }
    /** @param  array<string, mixed>  $pathParams  Path parameters. @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  Form body. @return array<string, mixed> */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = []): array { $response=$this->rawRequest($method,$this->expandPath($pathTemplate,$pathParams),$query,$headers,$body); if($response->body()==='') return ['success'=>true,'status'=>$response->status()]; return $response->json() ?? ['body'=>$response->body(),'status'=>$response->status()]; }
    /** @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  Form body. */
    private function rawRequest(string $method,string $path,array $query=[],array $headers=[],array $body=[]): Response
    {
        if(!$this->isConfigured()) throw new RuntimeException('StatusCake API key and base URL are required.');
        try { $method=strtoupper($method); $baseHeaders=['Authorization'=>'Bearer '.$this->apiKey,'Accept'=>'application/json']; $http=Http::withHeaders(array_merge($baseHeaders,$headers))->timeout(120); $url=$this->urlWithQuery($this->baseUrl.$path,$query); if($body!==[]||in_array($method,['POST','PUT','PATCH','DELETE'],true)) $http=$http->asForm(); $response=match($method){'GET'=>$http->get($url),'POST'=>$http->post($url,$body),'PUT'=>$http->put($url,$body),'PATCH'=>$http->patch($url,$body),'DELETE'=>$http->delete($url,$body),default=>throw new RuntimeException("Unsupported HTTP method: {$method}"),}; if(!$response->successful()){ $error=$response->json('message') ?? $response->json('error') ?? $response->body(); Log::error("StatusCake API error: {$method} {$path}",['status'=>$response->status(),'error'=>$error]); throw new RuntimeException('StatusCake API error ('.$response->status().'): '.(is_string($error)?$error:json_encode($error))); } return $response; } catch(\Illuminate\Http\Client\ConnectionException $e){ Log::error("StatusCake API connection error: {$method} {$path}",['error'=>$e->getMessage()]); throw new RuntimeException("Failed to connect to StatusCake API: {$e->getMessage()}"); }
    }
    /** @param  array<string, mixed>  $pathParams  Path parameters. */ private function expandPath(string $template,array $pathParams): string { return (string) preg_replace_callback('/\{([^}]+)\}/',function(array $m)use($pathParams):string{$key=$m[1]; if(!array_key_exists($key,$pathParams)||$pathParams[$key]===null||$pathParams[$key]==='') throw new RuntimeException($key.' must be a non-empty path parameter.'); return rawurlencode((string)$pathParams[$key]);},$template); }
    /** @param  array<string, mixed>  $query  Query parameters. */ private function urlWithQuery(string $url,array $query): string { $parts=[]; foreach($query as $key=>$value){ if($value===null||$value==='') continue; foreach(is_array($value)?$value:[$value] as $item){ if($item===null||$item==='') continue; $parts[]=rawurlencode((string)$key).'='.rawurlencode(is_bool($item)?($item?'true':'false'):(string)$item); }} return $parts===[]?$url:$url.'?'.implode('&',$parts); }
}
