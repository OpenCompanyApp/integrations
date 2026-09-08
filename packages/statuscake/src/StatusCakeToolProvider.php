<?php

namespace OpenCompany\Integrations\StatusCake;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for StatusCake.
 *
 * Exposes the official StatusCake Swagger operation set as endpoint-specific
 * agent tools and resolves account-specific API keys.
 */
class StatusCakeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'bearer_token','legacy_auth_type'=>'api_key','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Runtime calls use Authorization: Bearer <api_key>.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'statuscake'; } public function appMeta(): array { return ['label'=>'StatusCake','description'=>'Uptime, pagespeed, SSL, domain, heartbeat, contact groups, maintenance windows, locations, and alerts','icon'=>'ph:heartbeat','logo'=>'ph:heartbeat']; }
    public function integrationMeta(): array { return ['name'=>'StatusCake','description'=>'Manage StatusCake uptime, pagespeed, SSL, domain, heartbeat checks, contact groups, maintenance windows, monitoring locations, and alert history.','icon'=>'ph:heartbeat','logo'=>'ph:heartbeat','category'=>'analytics','badge'=>'verified','docs_url'=>'https://developers.statuscake.com/api/']; }
    public function configSchema(): array { return [['key'=>'api_key','type'=>'secret','label'=>'API Key','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','required'=>false,'default'=>'https://api.statuscake.com/v1']]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $key=(string)($config['api_key']??''); $baseUrl=rtrim((string)($config['url']??'https://api.statuscake.com/v1'),'/'); if($key==='') return ['success'=>false,'error'=>'StatusCake API key is required.']; try{ $response=Http::withHeaders(['Authorization'=>'Bearer '.$key,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/uptime'); if(!$response->successful()) return ['success'=>false,'error'=>'StatusCake API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to StatusCake at '.$baseUrl.'.']; }catch(\Throwable $e){ return ['success'=>false,'error'=>$e->getMessage()]; } }
    public function validationRules(): array { return ['api_key'=>'required|string','url'=>'nullable|url']; } public function credentialFields(): array { return [['key'=>'api_key','type'=>'secret','label'=>'API Key','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','required'=>false,'default'=>'https://api.statuscake.com/v1']]; }
    public function tools(): array { return [
  'statuscake_list_contact_groups' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListContactGroups',
  'type' => 'read',
  'name' => 'List Contact Groups',
  'description' => 'Returns a list of contact groups for an account.  Official StatusCake endpoint: GET /contact-groups.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_create_contact_group' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeCreateContactGroup',
  'type' => 'write',
  'name' => 'Create Contact Group',
  'description' => 'Creates a contact group with the given parameters.  Official StatusCake endpoint: POST /contact-groups.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_get_contact_group' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeGetContactGroup',
  'type' => 'read',
  'name' => 'Get Contact Group',
  'description' => 'Returns a contact group with the given id.  Official StatusCake endpoint: GET /contact-groups/{group_id}.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_update_contact_group' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeUpdateContactGroup',
  'type' => 'write',
  'name' => 'Update Contact Group',
  'description' => 'Updates a contact group with the given parameters.  Official StatusCake endpoint: PUT /contact-groups/{group_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_delete_contact_group' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeDeleteContactGroup',
  'type' => 'write',
  'name' => 'Delete Contact Group',
  'description' => 'Deletes a contact group with the given id.  Official StatusCake endpoint: DELETE /contact-groups/{group_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_list_heartbeat_tests' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListHeartbeatTests',
  'type' => 'read',
  'name' => 'List Heartbeat Tests',
  'description' => 'Returns a list of heartbeat checks for an account.  Official StatusCake endpoint: GET /heartbeat.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_create_heartbeat_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeCreateHeartbeatTest',
  'type' => 'write',
  'name' => 'Create Heartbeat Test',
  'description' => 'Creates a heartbeat check with the given parameters.  Official StatusCake endpoint: POST /heartbeat.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_get_heartbeat_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeGetHeartbeatTest',
  'type' => 'read',
  'name' => 'Get Heartbeat Test',
  'description' => 'Returns a heartbeat check with the given id.  Official StatusCake endpoint: GET /heartbeat/{test_id}.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_update_heartbeat_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeUpdateHeartbeatTest',
  'type' => 'write',
  'name' => 'Update Heartbeat Test',
  'description' => 'Updates a heartbeat check with the given parameters.  Official StatusCake endpoint: PUT /heartbeat/{test_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_delete_heartbeat_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeDeleteHeartbeatTest',
  'type' => 'write',
  'name' => 'Delete Heartbeat Test',
  'description' => 'Deletes a heartbeat check with the given id.  Official StatusCake endpoint: DELETE /heartbeat/{test_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_list_maintenance_windows' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListMaintenanceWindows',
  'type' => 'read',
  'name' => 'List Maintenance Windows',
  'description' => 'Returns a list of maintenance windows for an account.  Official StatusCake endpoint: GET /maintenance-windows.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_create_maintenance_window' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeCreateMaintenanceWindow',
  'type' => 'write',
  'name' => 'Create Maintenance Window',
  'description' => 'Creates a maintenance window with the given parameters.  Official StatusCake endpoint: POST /maintenance-windows.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_get_maintenance_window' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeGetMaintenanceWindow',
  'type' => 'read',
  'name' => 'Get Maintenance Window',
  'description' => 'Returns a maintenance window with the given id.  Official StatusCake endpoint: GET /maintenance-windows/{window_id}.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_update_maintenance_window' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeUpdateMaintenanceWindow',
  'type' => 'write',
  'name' => 'Update Maintenance Window',
  'description' => 'Updates a maintenance window with the given parameters.  Official StatusCake endpoint: PUT /maintenance-windows/{window_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_delete_maintenance_window' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeDeleteMaintenanceWindow',
  'type' => 'write',
  'name' => 'Delete Maintenance Window',
  'description' => 'Deletes a maintenance window with the given id.  Official StatusCake endpoint: DELETE /maintenance-windows/{window_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_list_pagespeed_tests' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListPagespeedTests',
  'type' => 'read',
  'name' => 'List Pagespeed Tests',
  'description' => 'Returns a list of pagespeed checks for an account.  Official StatusCake endpoint: GET /pagespeed.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_create_pagespeed_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeCreatePagespeedTest',
  'type' => 'write',
  'name' => 'Create Pagespeed Test',
  'description' => 'Creates a pagespeed check with the given parameters.  Official StatusCake endpoint: POST /pagespeed.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_get_pagespeed_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeGetPagespeedTest',
  'type' => 'read',
  'name' => 'Get Pagespeed Test',
  'description' => 'Returns a pagespeed check with the given id.  Official StatusCake endpoint: GET /pagespeed/{test_id}.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_update_pagespeed_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeUpdatePagespeedTest',
  'type' => 'write',
  'name' => 'Update Pagespeed Test',
  'description' => 'Updates a pagespeed check with the given parameters.  Official StatusCake endpoint: PUT /pagespeed/{test_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_delete_pagespeed_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeDeletePagespeedTest',
  'type' => 'write',
  'name' => 'Delete Pagespeed Test',
  'description' => 'Deletes a pagespeed check with the given id.  Official StatusCake endpoint: DELETE /pagespeed/{test_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_list_pagespeed_test_history' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListPagespeedTestHistory',
  'type' => 'read',
  'name' => 'List Pagespeed Test History',
  'description' => 'Returns a list of pagespeed check history results for a given id, detailing the runs performed on the StatusCake testing infrastruture. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current respons',
  'icon' => 'ph:heartbeat',
),
  'statuscake_list_ssl_tests' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListSslTests',
  'type' => 'read',
  'name' => 'List Ssl Tests',
  'description' => 'Returns a list of SSL checks for an account.  Official StatusCake endpoint: GET /ssl.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_create_ssl_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeCreateSslTest',
  'type' => 'write',
  'name' => 'Create Ssl Test',
  'description' => 'Creates an SSL check with the given parameters.  Official StatusCake endpoint: POST /ssl.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_get_ssl_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeGetSslTest',
  'type' => 'read',
  'name' => 'Get Ssl Test',
  'description' => 'Returns an SSL check with the given id.  Official StatusCake endpoint: GET /ssl/{test_id}.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_update_ssl_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeUpdateSslTest',
  'type' => 'write',
  'name' => 'Update Ssl Test',
  'description' => 'Updates an SSL check with the given parameters.  Official StatusCake endpoint: PUT /ssl/{test_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_delete_ssl_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeDeleteSslTest',
  'type' => 'write',
  'name' => 'Delete Ssl Test',
  'description' => 'Deletes an SSL check with the given id.  Official StatusCake endpoint: DELETE /ssl/{test_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_list_uptime_tests' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListUptimeTests',
  'type' => 'read',
  'name' => 'List Uptime Tests',
  'description' => 'Returns a list of uptime checks for an account.  Official StatusCake endpoint: GET /uptime.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_create_uptime_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeCreateUptimeTest',
  'type' => 'write',
  'name' => 'Create Uptime Test',
  'description' => 'Creates an uptime check with the given parameters.  Official StatusCake endpoint: POST /uptime.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_get_uptime_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeGetUptimeTest',
  'type' => 'read',
  'name' => 'Get Uptime Test',
  'description' => 'Returns an uptime check with the given id.  Official StatusCake endpoint: GET /uptime/{test_id}.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_update_uptime_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeUpdateUptimeTest',
  'type' => 'write',
  'name' => 'Update Uptime Test',
  'description' => 'Updates an uptime check with the given parameters.  Official StatusCake endpoint: PUT /uptime/{test_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_delete_uptime_test' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeDeleteUptimeTest',
  'type' => 'write',
  'name' => 'Delete Uptime Test',
  'description' => 'Deletes an uptime check with the given id.  Official StatusCake endpoint: DELETE /uptime/{test_id}.',
  'icon' => 'ph:pencil-simple',
),
  'statuscake_list_uptime_test_history' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListUptimeTestHistory',
  'type' => 'read',
  'name' => 'List Uptime Test History',
  'description' => 'Returns a list of uptime check history results for a given id, detailing the runs performed on the StatusCake testing infrastruture. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current response d',
  'icon' => 'ph:heartbeat',
),
  'statuscake_list_uptime_test_periods' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListUptimeTestPeriods',
  'type' => 'read',
  'name' => 'List Uptime Test Periods',
  'description' => 'Returns a list of uptime check periods for a given id, detailing the creation time of the period, when it ended and the duration. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current response docu',
  'icon' => 'ph:heartbeat',
),
  'statuscake_list_uptime_test_alerts' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListUptimeTestAlerts',
  'type' => 'read',
  'name' => 'List Uptime Test Alerts',
  'description' => 'Returns a list of uptime check alerts for a given id. The returned results are a paginated series. Alongside the response data is a `links` object referencing the current response document, `self`, and the next page in the series, `next`.  Official StatusCake ',
  'icon' => 'ph:heartbeat',
),
  'statuscake_list_uptime_monitoring_locations' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListUptimeMonitoringLocations',
  'type' => 'read',
  'name' => 'List Uptime Monitoring Locations',
  'description' => 'Returns a list of locations detailing server information for uptime monitoring servers. This information can be used to create further checks using the API.  Official StatusCake endpoint: GET /uptime-locations.',
  'icon' => 'ph:heartbeat',
),
  'statuscake_list_pagespeed_monitoring_locations' => array (
  'class' => 'OpenCompany\\Integrations\\StatusCake\\Tools\\StatusCakeListPagespeedMonitoringLocations',
  'type' => 'read',
  'name' => 'List Pagespeed Monitoring Locations',
  'description' => 'Returns a list of locations detailing server information for pagespeed monitoring servers. This information can be used to create further checks using the API.  Official StatusCake endpoint: GET /pagespeed-locations.',
  'icon' => 'ph:heartbeat',
),
    ]; }
    public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); } public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/statuscake.md'; }
    /** @param  array<string, mixed>  $context  Runtime account context. */ private function resolveService(array $context=[]): StatusCakeService { $account=$context['account']??null; if($account!==null){ $creds=app(CredentialResolver::class); return new StatusCakeService(apiKey:$creds->get('statuscake','api_key','',$account), baseUrl:$creds->get('statuscake','url','https://api.statuscake.com/v1',$account)); } return app(StatusCakeService::class); }
}
