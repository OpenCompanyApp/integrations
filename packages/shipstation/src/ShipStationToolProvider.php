<?php

namespace OpenCompany\Integrations\ShipStation;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/** Tool catalog and configuration metadata for ShipStation V2. */
class ShipStationToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const RAW_TOOLS = [
        'shipstation_api_get'=>['ShipStationApiGet','read','API GET','Call a safe relative ShipStation API GET path.','ph:code'],
        'shipstation_api_post'=>['ShipStationApiPost','write','API POST','Call a safe relative ShipStation API POST path.','ph:code'],
        'shipstation_api_put'=>['ShipStationApiPut','write','API PUT','Call a safe relative ShipStation API PUT path.','ph:code'],
        'shipstation_api_patch'=>['ShipStationApiPatch','write','API PATCH','Call a safe relative ShipStation API PATCH path.','ph:code'],
        'shipstation_api_delete'=>['ShipStationApiDelete','write','API DELETE','Call a safe relative ShipStation API DELETE path.','ph:code'],
    ];
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'api_key_header','legacy_auth_type'=>'api_key','credential_mode'=>'required_secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['api_key'],'notes'=>['ShipStation V2 uses the API-Key request header.']], 'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']], 'runtime_requirements'=>[], 'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'shipstation'; }
    public function appMeta(): array { return ['label'=>'ShipStation','description'=>'ShipStation V2 shipping, labels, inventory, rates, warehouses, and webhooks','icon'=>'ph:package','logo'=>'ph:package']; }
    public function integrationMeta(): array { return ['name'=>'ShipStation','description'=>'Manage ShipStation V2 batches, carriers, labels, inventory, shipments, rates, pickups, manifests, package types, purchase orders, suppliers, totes, warehouses, users, webhooks, and raw API calls.','icon'=>'ph:package','logo'=>'ph:package','category'=>'productivity','badge'=>'verified','docs_url'=>'https://docs.shipstation.com/apis/openapi']; }
    public function configSchema(): array { return $this->credentialFields(); }
    /** @param array<string, mixed> $config @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array { try { $apiKey=(string)($config['api_key']??''); if($apiKey==='') return ['success'=>false,'error'=>'ShipStation API key is required.']; $baseUrl=rtrim((string)($config['url']??''), '/') ?: 'https://api.shipstation.com'; $response=Http::withHeaders(['API-Key'=>$apiKey])->acceptJson()->timeout(20)->get($baseUrl.'/v2/carriers'); return $response->successful()?['success'=>true,'message'=>'Connected to ShipStation API.']:['success'=>false,'error'=>'ShipStation API returned HTTP '.$response->status().'.']; } catch (\Throwable $e) { return ['success'=>false,'error'=>$e->getMessage()]; } }
    public function validationRules(): array { return ['api_key'=>'required|string','url'=>'nullable|string']; }
    public function credentialFields(): array { return [['key'=>'api_key','type'=>'secret','label'=>'API Key','placeholder'=>'ShipStation V2 API key','hint'=>'ShipStation V2 API key sent as API-Key header.','required'=>true], ['key'=>'url','type'=>'text','label'=>'API URL','placeholder'=>'https://api.shipstation.com','hint'=>'Optional ShipStation API root URL override.','required'=>false]]; }
    public function tools(): array { $tools=[]; foreach(ShipStationService::operations() as $operation=>$definition){[, , , $type,$name,$description]=$definition; $class=$this->classNameForOperation($operation); $tools['shipstation_'.$operation]=['class'=>__NAMESPACE__.'\\Tools\\'.$class,'type'=>$type,'name'=>$name,'description'=>$description,'icon'=>$type==='read'?'ph:list':'ph:pencil-simple'];} foreach(self::RAW_TOOLS as $slug=>[$class,$type,$name,$description,$icon]){$tools[$slug]=['class'=>__NAMESPACE__.'\\Tools\\'.$class,'type'=>$type,'name'=>$name,'description'=>$description,'icon'=>$icon];} return $tools; }
    public function isIntegration(): bool { return true; }
    /** @param array<string, mixed> $context */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param array<string, mixed> $context */
    private function resolveService(array $context = []): ShipStationService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new ShipStationService(apiKey:$creds->get('shipstation','api_key','',$account), baseUrl:$creds->get('shipstation','url','https://api.shipstation.com',$account));} return app(ShipStationService::class); }
    public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/shipstation.md'; }
    private function classNameForOperation(string $operation): string { return 'ShipStation'.str_replace(' ', '', ucwords(str_replace('_', ' ', $operation))); }
}
