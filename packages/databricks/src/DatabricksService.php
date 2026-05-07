<?php

namespace OpenCompany\Integrations\Databricks;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Databricks REST API.
 *
 * Handles workspace-host authentication, account/workspace path defaults,
 * JSON request dispatch, response parsing, and API error normalization.
 */
class DatabricksService
{
    /**
     * @param  string  $apiToken  Databricks personal access token or OAuth token.
     * @param  string  $baseUrl  Workspace or account Databricks host URL.
     * @param  string  $accountId  Optional account id for account-level endpoints.
     * @param  string  $workspaceId  Optional workspace id for X-Databricks-Org-Id.
     */
    public function __construct(private string $apiToken = '', private string $baseUrl = '', private string $accountId = '', private string $workspaceId = '') { $this->baseUrl = rtrim($this->baseUrl, '/'); }
    public function isConfigured(): bool { return $this->apiToken !== '' && $this->baseUrl !== ''; }
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
        if (!$this->isConfigured()) throw new RuntimeException('Databricks host URL and API token are required.');
        try { $method=strtoupper($method); $url=$this->urlWithQuery($this->baseUrl.$path,$query); $baseHeaders=['Authorization'=>'Bearer '.$this->apiToken,'Accept'=>'application/json']; if($body!==[]||in_array($method,['POST','PUT','PATCH','DELETE'],true)) $baseHeaders['Content-Type']='application/json'; if($this->workspaceId!=='') $baseHeaders['X-Databricks-Org-Id']=$this->workspaceId; $http=Http::withHeaders(array_merge($baseHeaders,$headers))->timeout(120); $response=match($method){'GET'=>$http->get($url),'POST'=>$http->post($url,$body),'PUT'=>$http->put($url,$body),'PATCH'=>$http->patch($url,$body),'DELETE'=>$http->delete($url,$body),default=>throw new RuntimeException("Unsupported HTTP method: {$method}"),}; if(!$response->successful()){ $error=$response->json('message')??$response->json('error')??$response->json('error_code')??$response->body(); Log::error("Databricks API error: {$method} {$path}",['status'=>$response->status(),'error'=>$error]); throw new RuntimeException('Databricks API error ('.$response->status().'): '.(is_string($error)?$error:json_encode($error))); } return $response; } catch (\Illuminate\Http\Client\ConnectionException $e) { Log::error("Databricks API connection error: {$method} {$path}", ['error'=>$e->getMessage()]); throw new RuntimeException("Failed to connect to Databricks API: {$e->getMessage()}"); }
    }
    /** @param  array<string, mixed>  $pathParams  Path parameters. */ private function expandPath(string $template, array $pathParams): string { return (string) preg_replace_callback('/\{([^}]+)\}/', function(array $m) use ($pathParams): string { $key=$m[1]; $value=$pathParams[$key]??($key==='account_id'?$this->accountId:($key==='workspace_id'?$this->workspaceId:null)); if($value===null||$value==='') throw new RuntimeException($key.' must be a non-empty path parameter.'); return rawurlencode((string)$value); }, $template); }
    /** @param  array<string, mixed>  $query  Query parameters. */ private function urlWithQuery(string $url, array $query): string { $parts=[]; foreach($query as $key=>$value){ if($value===null||$value==='')continue; foreach(is_array($value)?$value:[$value] as $item){ if($item===null||$item==='')continue; $encodedValue=is_bool($item)?($item?'true':'false'):(string)$item; $parts[]=rawurlencode((string)$key).'='.rawurlencode($encodedValue); }} return $parts===[]?$url:$url.'?'.implode('&',$parts); }
}