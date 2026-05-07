<?php

namespace OpenCompany\Integrations\Checkly;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Checkly Public API.
 *
 * Handles bearer-token authentication, account headers, path/query construction,
 * JSON request dispatch, response parsing, and Checkly error normalization.
 */
class ChecklyService
{
    /**
     * @param  string  $apiKey  Checkly API key for bearer authentication.
     * @param  string  $accountId  Checkly account ID sent with X-Checkly-Account.
     * @param  string  $baseUrl  Checkly API base URL.
     */
    public function __construct(private string $apiKey = '', private string $accountId = '', private string $baseUrl = 'https://api.checklyhq.com') { $this->baseUrl = rtrim($this->baseUrl, '/'); }
    public function isConfigured(): bool { return $this->apiKey !== '' && $this->accountId !== '' && $this->baseUrl !== ''; }
    /** @param  array<string, mixed>  $pathParams  Path parameters. @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  JSON body. @return array<string, mixed> */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = []): array { $response=$this->rawRequest($method,$this->expandPath($pathTemplate,$pathParams),$query,$headers,$body); if($response->body()==='') return ['success'=>true,'status'=>$response->status()]; return $response->json() ?? ['body'=>$response->body(),'status'=>$response->status()]; }
    /** @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  JSON body. */
    private function rawRequest(string $method,string $path,array $query=[],array $headers=[],array $body=[]): Response
    {
        if(!$this->isConfigured()) throw new RuntimeException('Checkly API key, account ID, and base URL are required.');
        try { $method=strtoupper($method); $baseHeaders=['Authorization'=>'Bearer '.$this->apiKey,'X-Checkly-Account'=>$this->accountId,'Accept'=>'application/json']; if($body!==[]||in_array($method,['POST','PUT','PATCH','DELETE'],true)) $baseHeaders['Content-Type']='application/json'; $http=Http::withHeaders(array_merge($baseHeaders,$headers))->timeout(120); $url=$this->urlWithQuery($this->baseUrl.$path,$query); $response=match($method){'GET'=>$http->get($url),'POST'=>$http->post($url,$body),'PUT'=>$http->put($url,$body),'PATCH'=>$http->patch($url,$body),'DELETE'=>$http->delete($url,$body),default=>throw new RuntimeException("Unsupported HTTP method: {$method}"),}; if(!$response->successful()){ $error=$response->json('message') ?? $response->json('error') ?? $response->body(); Log::error("Checkly API error: {$method} {$path}",['status'=>$response->status(),'error'=>$error]); throw new RuntimeException('Checkly API error ('.$response->status().'): '.(is_string($error)?$error:json_encode($error))); } return $response; } catch(\Illuminate\Http\Client\ConnectionException $e){ Log::error("Checkly API connection error: {$method} {$path}",['error'=>$e->getMessage()]); throw new RuntimeException("Failed to connect to Checkly API: {$e->getMessage()}"); }
    }
    /** @param  array<string, mixed>  $pathParams  Path parameters. */ private function expandPath(string $template,array $pathParams): string { return (string) preg_replace_callback('/\{([^}]+)\}/',function(array $m)use($pathParams):string{$key=$m[1]; if(!array_key_exists($key,$pathParams)||$pathParams[$key]===null||$pathParams[$key]==='') throw new RuntimeException($key.' must be a non-empty path parameter.'); return rawurlencode((string)$pathParams[$key]);},$template); }
    /** @param  array<string, mixed>  $query  Query parameters. */ private function urlWithQuery(string $url,array $query): string { $parts=[]; foreach($query as $key=>$value){ if($value===null||$value==='') continue; foreach(is_array($value)?$value:[$value] as $item){ if($item===null||$item==='') continue; $parts[]=rawurlencode((string)$key).'='.rawurlencode(is_bool($item)?($item?'true':'false'):(string)$item); }} return $parts===[]?$url:$url.'?'.implode('&',$parts); }
}
