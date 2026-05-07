<?php

namespace OpenCompany\Integrations\Miro;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Miro Developer Platform API.
 *
 * Handles OAuth bearer-token authentication, path/query construction, JSON and
 * multipart request dispatch, response parsing, and Miro error normalization.
 */
class MiroService
{
    /**
     * @param  string  $accessToken  Miro OAuth access token.
     * @param  string  $baseUrl  Miro API base URL.
     */
    public function __construct(private string $accessToken = '', private string $baseUrl = 'https://api.miro.com') { $this->baseUrl = rtrim($this->baseUrl, '/'); }
    public function isConfigured(): bool { return $this->accessToken !== '' && $this->baseUrl !== ''; }
    /** @param  array<string, mixed>  $pathParams  Path parameters. @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  Request body. @return array<string, mixed> */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = [], string $contentType = 'application/json'): array { $response=$this->rawRequest($method,$this->expandPath($pathTemplate,$pathParams),$query,$headers,$body,$contentType); if($response->body()==='') return ['success'=>true,'status'=>$response->status()]; return $response->json() ?? ['body'=>$response->body(),'status'=>$response->status()]; }
    /** @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $body  Request body. */
    private function rawRequest(string $method,string $path,array $query=[],array $headers=[],array $body=[],string $contentType='application/json'): Response
    {
        if(!$this->isConfigured()) throw new RuntimeException('Miro access token and base URL are required.');
        try { $method=strtoupper($method); $baseHeaders=['Authorization'=>'Bearer '.$this->accessToken,'Accept'=>'application/json']; if($body!==[]||in_array($method,['POST','PUT','PATCH','DELETE'],true)) $baseHeaders['Content-Type']=$contentType; $http=Http::withHeaders(array_merge($baseHeaders,$headers))->timeout(120); $url=$this->urlWithQuery($this->baseUrl.$path,$query); if($contentType==='multipart/form-data' && $body!==[]) $http=$http->asMultipart(); $payload=$contentType==='multipart/form-data' ? $this->multipartParts($body) : $body; $response=match($method){'GET'=>$http->get($url),'POST'=>$http->post($url,$payload),'PUT'=>$http->put($url,$payload),'PATCH'=>$http->patch($url,$payload),'DELETE'=>$http->delete($url,$payload),default=>throw new RuntimeException("Unsupported HTTP method: {$method}"),}; if(!$response->successful()){ $error=$response->json('message') ?? $response->json('error.message') ?? $response->json('error') ?? $response->body(); Log::error("Miro API error: {$method} {$path}",['status'=>$response->status(),'error'=>$error]); throw new RuntimeException('Miro API error ('.$response->status().'): '.(is_string($error)?$error:json_encode($error))); } return $response; } catch(\Illuminate\Http\Client\ConnectionException $e){ Log::error("Miro API connection error: {$method} {$path}",['error'=>$e->getMessage()]); throw new RuntimeException("Failed to connect to Miro API: {$e->getMessage()}"); }
    }
    /** @param  array<string, mixed>  $pathParams  Path parameters. */ private function expandPath(string $template,array $pathParams): string { return (string) preg_replace_callback('/\{([^}]+)\}/',function(array $m)use($pathParams):string{$key=$m[1]; if(!array_key_exists($key,$pathParams)||$pathParams[$key]===null||$pathParams[$key]==='') throw new RuntimeException($key.' must be a non-empty path parameter.'); return rawurlencode((string)$pathParams[$key]);},$template); }
    /** @param  array<string, mixed>  $query  Query parameters. */ private function urlWithQuery(string $url,array $query): string { $parts=[]; foreach($query as $key=>$value){ if($value===null||$value==='') continue; foreach(is_array($value)?$value:[$value] as $item){ if($item===null||$item==='') continue; $parts[]=rawurlencode((string)$key).'='.rawurlencode(is_bool($item)?($item?'true':'false'):(string)$item); }} return $parts===[]?$url:$url.'?'.implode('&',$parts); }
    /** @param  array<string, mixed>  $body  Multipart fields or prebuilt multipart part arrays. @return array<int, array<string, mixed>> */ private function multipartParts(array $body): array { $parts=[]; foreach($body as $name=>$value){ if(is_array($value)&&array_key_exists('name',$value)&&array_key_exists('contents',$value)){ $parts[]=$value; continue; } $parts[]=['name'=>(string)$name,'contents'=>is_scalar($value)?(string)$value:json_encode($value)]; } return $parts; }
}
