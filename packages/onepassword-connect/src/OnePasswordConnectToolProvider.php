<?php

namespace OpenCompany\Integrations\OnePasswordConnect;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for 1Password Connect.
 *
 * Exposes the official 1Password Connect OpenAPI operation set as endpoint-specific
 * agent tools and resolves account-specific Connect tokens.
 */
class OnePasswordConnectToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'bearer_token','legacy_auth_type'=>'api_token','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Send the Connect Server access token using Authorization: Bearer <token>.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'onepassword-connect'; } public function appMeta(): array { return ['label'=>'1Password Connect','description'=>'Vaults, items, files, API activity, health, heartbeat, and metrics through Connect Server','icon'=>'ph:vault','logo'=>'ph:vault']; }
    public function integrationMeta(): array { return ['name'=>'1Password Connect','description'=>'Access 1Password Connect Server vaults, items, files, activity, health, heartbeat, and metrics.','icon'=>'ph:vault','logo'=>'ph:vault','category'=>'productivity','badge'=>'verified','docs_url'=>'https://developer.1password.com/docs/connect/api-reference']; }
    public function configSchema(): array { return [['key'=>'api_token','type'=>'secret','label'=>'Connect Access Token','required'=>true],['key'=>'url','type'=>'url','label'=>'Connect API Base URL','required'=>true,'default'=>'http://localhost:8080/v1']]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $token=(string)($config['api_token']??''); $baseUrl=rtrim((string)($config['url']??'http://localhost:8080/v1'),'/'); if($token==='') return ['success'=>false,'error'=>'1Password Connect access token is required.']; try{ $response=Http::withHeaders(['Authorization'=>'Bearer '.$token,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/heartbeat'); if(!$response->successful()) return ['success'=>false,'error'=>'1Password Connect API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to 1Password Connect at '.$baseUrl.'.']; }catch(\Throwable $e){ return ['success'=>false,'error'=>$e->getMessage()]; } }
    public function validationRules(): array { return ['api_token'=>'required|string','url'=>'required|url']; } public function credentialFields(): array { return [['key'=>'api_token','type'=>'secret','label'=>'Connect Access Token','required'=>true],['key'=>'url','type'=>'url','label'=>'Connect API Base URL','required'=>true,'default'=>'http://localhost:8080/v1']]; }
    public function tools(): array { return [
  'onepassword_connect_get_api_activity' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetApiActivity',
  'type' => 'read',
  'name' => 'Get Api Activity',
  'description' => 'Retrieve a list of API Requests that have been made.  Official 1Password Connect endpoint: GET /activity.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_get_vaults' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetVaults',
  'type' => 'read',
  'name' => 'Get Vaults',
  'description' => 'Get all Vaults  Official 1Password Connect endpoint: GET /vaults.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_get_vault_by_id' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetVaultById',
  'type' => 'read',
  'name' => 'Get Vault By Id',
  'description' => 'Get Vault details and metadata  Official 1Password Connect endpoint: GET /vaults/{vaultUuid}.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_get_vault_items' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetVaultItems',
  'type' => 'read',
  'name' => 'Get Vault Items',
  'description' => 'Get all items for inside a Vault  Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_create_vault_item' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectCreateVaultItem',
  'type' => 'write',
  'name' => 'Create Vault Item',
  'description' => 'Create a new Item  Official 1Password Connect endpoint: POST /vaults/{vaultUuid}/items.',
  'icon' => 'ph:pencil-simple',
),
  'onepassword_connect_get_vault_item_by_id' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetVaultItemById',
  'type' => 'read',
  'name' => 'Get Vault Item By Id',
  'description' => 'Get the details of an Item  Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items/{itemUuid}.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_update_vault_item' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectUpdateVaultItem',
  'type' => 'write',
  'name' => 'Update Vault Item',
  'description' => 'Update an Item  Official 1Password Connect endpoint: PUT /vaults/{vaultUuid}/items/{itemUuid}.',
  'icon' => 'ph:pencil-simple',
),
  'onepassword_connect_delete_vault_item' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectDeleteVaultItem',
  'type' => 'write',
  'name' => 'Delete Vault Item',
  'description' => 'Delete an Item  Official 1Password Connect endpoint: DELETE /vaults/{vaultUuid}/items/{itemUuid}.',
  'icon' => 'ph:pencil-simple',
),
  'onepassword_connect_patch_vault_item' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectPatchVaultItem',
  'type' => 'write',
  'name' => 'Patch Vault Item',
  'description' => 'Applies a modified [RFC6902 JSON Patch](https://tools.ietf.org/html/rfc6902) document to an Item or ItemField. This endpoint only supports `add`, `remove` and `replace` operations. When modifying a specific ItemField, the ItemField\'s ID in the `path` attribute',
  'icon' => 'ph:pencil-simple',
),
  'onepassword_connect_get_item_files' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetItemFiles',
  'type' => 'read',
  'name' => 'Get Item Files',
  'description' => 'Get all the files inside an Item  Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items/{itemUuid}/files.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_get_details_of_file_by_id' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetDetailsOfFileById',
  'type' => 'read',
  'name' => 'Get Details Of File By Id',
  'description' => 'Get the details of a File  Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items/{itemUuid}/files/{fileUuid}.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_download_file_by_id' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectDownloadFileById',
  'type' => 'read',
  'name' => 'Download File By Id',
  'description' => 'Get the content of a File  Official 1Password Connect endpoint: GET /vaults/{vaultUuid}/items/{itemUuid}/files/{fileUuid}/content.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_get_heartbeat' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetHeartbeat',
  'type' => 'read',
  'name' => 'Get Heartbeat',
  'description' => 'Ping the server for liveness  Official 1Password Connect endpoint: GET /heartbeat.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_get_server_health' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetServerHealth',
  'type' => 'read',
  'name' => 'Get Server Health',
  'description' => 'Get state of the server and its dependencies.  Official 1Password Connect endpoint: GET /health.',
  'icon' => 'ph:vault',
),
  'onepassword_connect_get_prometheus_metrics' => array (
  'class' => 'OpenCompany\\Integrations\\OnePasswordConnect\\Tools\\OnePasswordConnectGetPrometheusMetrics',
  'type' => 'read',
  'name' => 'Get Prometheus Metrics',
  'description' => 'See Prometheus documentation for a complete data model.  Official 1Password Connect endpoint: GET /metrics.',
  'icon' => 'ph:vault',
),
    ]; }
    public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); } public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/onepassword-connect.md'; }
    /** @param  array<string, mixed>  $context  Runtime account context. */ private function resolveService(array $context=[]): OnePasswordConnectService { $account=$context['account']??null; if($account!==null){ $creds=app(CredentialResolver::class); return new OnePasswordConnectService(apiToken:$creds->get('onepassword-connect','api_token','',$account), baseUrl:$creds->get('onepassword-connect','url','http://localhost:8080/v1',$account)); } return app(OnePasswordConnectService::class); }
}
