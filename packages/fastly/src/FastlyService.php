<?php

namespace OpenCompany\Integrations\Fastly;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Fastly API.
 *
 * Handles Fastly-Key authentication, API/RT host selection, form and JSON
 * request dispatch, path/query/header construction, and API error handling.
 */
class FastlyService
{
    /** @param  string  $apiToken  Fastly API token. @param  string  $apiUrl  Primary Fastly API base URL. @param  string  $rtUrl  Real-time stats API base URL. */
    public function __construct(private string $apiToken = '', private string $apiUrl = 'https://api.fastly.com', private string $rtUrl = 'https://rt.fastly.com') { $this->apiUrl = rtrim($this->apiUrl, '/'); $this->rtUrl = rtrim($this->rtUrl, '/'); }
    public function isConfigured(): bool { return $this->apiToken !== ''; }
    /** @return array<string, array<string, mixed>> */ public static function operations(): array { return FastlyOperations::all(); }
    /** @param  array<string, mixed>  $operation  Operation metadata. @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */
    public function executeOperation(array $operation, array $args = []): array
    {
        $pathParams=$this->mapped($args, $operation['path_params'] ?? [], true); $query=$this->mapped($args, $operation['query_params'] ?? []); $headers=$this->mapped($args, $operation['header_params'] ?? []); $form=$this->mapped($args, $operation['form_params'] ?? []); $body=null; $bodyParam=$operation['body_param'] ?? null;
        if ($bodyParam !== null) { $body=$args['body'] ?? $args[$bodyParam] ?? null; if (($operation['body_required'] ?? false) && ($body===null || $body==='' || $body===[])) throw new RuntimeException($bodyParam.' body parameter is required.'); }
        return $this->request((string)$operation['method'], (string)$operation['path'], $pathParams, $query, $headers, $form, $body, (string)($operation['operation_host'] ?? 'https://api.fastly.com'));
    }
    /** @param  array<string, mixed>  $pathParams  Path parameters. @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $form  Form fields. @return array<string, mixed> */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $form = [], mixed $body = null, string $operationHost = 'https://api.fastly.com'): array
    {
        $response=$this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $form, $body, $operationHost);
        if ($response->status()===204 || $response->body()==='') return ['success'=>true,'status'=>$response->status()];
        $contentType=(string)$response->header('Content-Type'); if(!str_contains($contentType,'json')) return ['body'=>$response->body(),'content_type'=>$contentType,'status'=>$response->status()]; return $response->json() ?? [];
    }
    /** @param  array<string, mixed>  $query  Query parameters. @param  array<string, mixed>  $headers  Extra headers. @param  array<string, mixed>  $form  Form fields. */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $form = [], mixed $body = null, string $operationHost = 'https://api.fastly.com'): Response
    {
        if(!$this->isConfigured()) throw new RuntimeException('Fastly API token is not configured.'); $method=strtoupper($method); $base=str_contains($operationHost,'rt.fastly.com')?$this->rtUrl:$this->apiUrl; $url=$this->urlWithQuery($base.$path,$query);
        try { $http=Http::withHeaders(array_merge(['Fastly-Key'=>$this->apiToken,'Accept'=>'application/json'], $headers))->timeout(120); if($form!==[]){$http=$http->asForm(); $response=match($method){'POST'=>$http->post($url,$form),'PUT'=>$http->put($url,$form),'PATCH'=>$http->patch($url,$form),'DELETE'=>$http->delete($url,$form),default=>$http->send($method,$url,['form_params'=>$form])};} elseif($body!==null){$response=is_array($body)?$http->withHeaders(['Content-Type'=>'application/json'])->send($method,$url,['json'=>$body]):$http->withBody((string)$body,'application/octet-stream')->send($method,$url);} else { $response=match($method){'GET'=>$http->get($url),'POST'=>$http->post($url,[]),'PUT'=>$http->put($url,[]),'PATCH'=>$http->patch($url,[]),'DELETE'=>$http->delete($url,[]),default=>$http->send($method,$url)}; } } catch (\Illuminate\Http\Client\ConnectionException $e) { Log::error("Fastly API connection error: {$method} {$path}", ['error'=>$e->getMessage()]); throw new RuntimeException('Failed to connect to Fastly API: '.$e->getMessage()); }
        if(!$response->successful()){ $error=$response->json('msg') ?? $response->json('message') ?? $response->json('error') ?? $response->body(); Log::error("Fastly API error: {$method} {$path}", ['status'=>$response->status(),'error'=>$error]); throw new RuntimeException('Fastly API error ('.$response->status().'): '.(is_string($error)?$error:json_encode($error))); } return $response;
    }
    /** @param  array<string, mixed>  $args  Tool arguments. @param  array<string, string>  $map  Official name to argument key map. @return array<string, mixed> */ private function mapped(array $args, array $map, bool $required=false): array { $out=[]; foreach($map as $official=>$key){ if(!array_key_exists($key,$args)||$args[$key]===null||$args[$key]===''){ if($required) throw new RuntimeException($key.' must be a non-empty parameter.'); continue;} $out[$official]=$args[$key]; } return $out; }
    /** @param  array<string, mixed>  $pathParams  Path parameters. */ private function expandPath(string $template, array $pathParams): string { return (string)preg_replace_callback('/\{([^}]+)\}/', function(array $m) use($pathParams): string { $key=$m[1]; if(!array_key_exists($key,$pathParams)||$pathParams[$key]===null||$pathParams[$key]==='') throw new RuntimeException($key.' must be a non-empty path parameter.'); return rawurlencode((string)$pathParams[$key]); }, $template); }
    /** @param  array<string, mixed>  $query  Query parameters. */ private function urlWithQuery(string $url, array $query): string { $parts=[]; foreach($query as $key=>$value){ if($value===null||$value==='')continue; foreach(is_array($value)?$value:[$value] as $item){ if($item===null||$item==='')continue; $parts[]=rawurlencode((string)$key).'='.rawurlencode(is_bool($item)?($item?'true':'false'):(string)$item); }} return $parts===[]?$url:$url.'?'.implode('&',$parts); }
}