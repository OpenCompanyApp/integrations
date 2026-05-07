<?php

namespace OpenCompany\Integrations\Airbyte;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Airbyte.
 *
 * Exposes the official Airbyte OpenAPI operation set as endpoint-specific agent
 * tools and resolves account-specific bearer tokens in multi-account hosts.
 */
class AirbyteToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'bearer_token','legacy_auth_type'=>'api_token','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Use an Airbyte Cloud or self-managed API bearer token.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'airbyte'; } public function appMeta(): array { return ['label'=>'Airbyte','description'=>'Data movement workspaces, sources, destinations, connections, jobs, users, and permissions','icon'=>'ph:database','logo'=>'ph:database']; }
    public function integrationMeta(): array { return ['name'=>'Airbyte','description'=>'Manage Airbyte sources, destinations, connections, jobs, workspaces, organizations, users, permissions, and OAuth credentials.','icon'=>'ph:database','logo'=>'ph:database','category'=>'data','badge'=>'verified','docs_url'=>'https://github.com/airbytehq/airbyte-api-python-sdk/blob/main/airbyte-api.openapi.yaml']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://api.airbyte.com/v1','default'=>'https://api.airbyte.com/v1']]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $token=(string)($config['access_token']??''); $baseUrl=rtrim((string)($config['url']??'https://api.airbyte.com/v1'),'/'); if($token==='')return ['success'=>false,'error'=>'Airbyte access token is required.']; try{$response=Http::withHeaders(['Authorization'=>'Bearer '.$token,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/health'); if(!$response->successful())return ['success'=>false,'error'=>'Airbyte API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to Airbyte at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['access_token'=>'required|string','url'=>'nullable|url']; } public function credentialFields(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','required'=>false,'default'=>'https://api.airbyte.com/v1']]; }
    public function tools(): array { return [
  'airbyte_get_health_check' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteGetHealthCheck',
  'type' => 'read',
  'name' => 'Health Check',
  'description' => 'Health Check Official Airbyte endpoint: GET /health',
  'icon' => 'ph:database',
),
  'airbyte_list_jobs' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteListJobs',
  'type' => 'read',
  'name' => 'List Jobs by sync type',
  'description' => 'List Jobs by sync type Official Airbyte endpoint: GET /jobs',
  'icon' => 'ph:database',
),
  'airbyte_create_job' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteCreateJob',
  'type' => 'write',
  'name' => 'Trigger a sync or reset job of a connection',
  'description' => 'Trigger a sync or reset job of a connection Official Airbyte endpoint: POST /jobs',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_get_job' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteGetJob',
  'type' => 'read',
  'name' => 'Get Job status and details',
  'description' => 'Get Job status and details Official Airbyte endpoint: GET /jobs/{jobId}',
  'icon' => 'ph:database',
),
  'airbyte_cancel_job' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteCancelJob',
  'type' => 'write',
  'name' => 'Cancel a running Job',
  'description' => 'Cancel a running Job Official Airbyte endpoint: DELETE /jobs/{jobId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_list_sources' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteListSources',
  'type' => 'read',
  'name' => 'List sources',
  'description' => 'List sources Official Airbyte endpoint: GET /sources',
  'icon' => 'ph:database',
),
  'airbyte_create_source' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteCreateSource',
  'type' => 'write',
  'name' => 'Create a source',
  'description' => 'Create a source Official Airbyte endpoint: POST /sources Creates a source given a name, workspace id, and a json blob containing the configuration for the source.',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_get_source' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteGetSource',
  'type' => 'read',
  'name' => 'Get Source details',
  'description' => 'Get Source details Official Airbyte endpoint: GET /sources/{sourceId}',
  'icon' => 'ph:database',
),
  'airbyte_patch_source' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbytePatchSource',
  'type' => 'write',
  'name' => 'Update a Source',
  'description' => 'Update a Source Official Airbyte endpoint: PATCH /sources/{sourceId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_put_source' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbytePutSource',
  'type' => 'write',
  'name' => 'Update a Source and fully overwrite it',
  'description' => 'Update a Source and fully overwrite it Official Airbyte endpoint: PUT /sources/{sourceId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_delete_source' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteDeleteSource',
  'type' => 'write',
  'name' => 'Delete a Source',
  'description' => 'Delete a Source Official Airbyte endpoint: DELETE /sources/{sourceId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_list_destinations' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteListDestinations',
  'type' => 'read',
  'name' => 'List destinations',
  'description' => 'List destinations Official Airbyte endpoint: GET /destinations',
  'icon' => 'ph:database',
),
  'airbyte_create_destination' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteCreateDestination',
  'type' => 'write',
  'name' => 'Create a destination',
  'description' => 'Create a destination Official Airbyte endpoint: POST /destinations Creates a destination given a name, workspace id, and a json blob containing the configuration for the source.',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_get_destination' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteGetDestination',
  'type' => 'read',
  'name' => 'Get Destination details',
  'description' => 'Get Destination details Official Airbyte endpoint: GET /destinations/{destinationId}',
  'icon' => 'ph:database',
),
  'airbyte_delete_destination' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteDeleteDestination',
  'type' => 'write',
  'name' => 'Delete a Destination',
  'description' => 'Delete a Destination Official Airbyte endpoint: DELETE /destinations/{destinationId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_patch_destination' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbytePatchDestination',
  'type' => 'write',
  'name' => 'Update a Destination',
  'description' => 'Update a Destination Official Airbyte endpoint: PATCH /destinations/{destinationId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_put_destination' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbytePutDestination',
  'type' => 'write',
  'name' => 'Update a Destination and fully overwrite it',
  'description' => 'Update a Destination and fully overwrite it Official Airbyte endpoint: PUT /destinations/{destinationId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_initiate_oauth' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteInitiateOAuth',
  'type' => 'write',
  'name' => 'Initiate OAuth for a source',
  'description' => 'Initiate OAuth for a source Official Airbyte endpoint: POST /sources/initiateOAuth Given a source ID, workspace ID, and redirect URL, initiates OAuth for the source. This returns a fully formed URL for performing user...',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_create_connection' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteCreateConnection',
  'type' => 'write',
  'name' => 'Create a connection',
  'description' => 'Create a connection Official Airbyte endpoint: POST /connections',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_list_connections' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteListConnections',
  'type' => 'read',
  'name' => 'List connections',
  'description' => 'List connections Official Airbyte endpoint: GET /connections',
  'icon' => 'ph:database',
),
  'airbyte_get_connection' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteGetConnection',
  'type' => 'read',
  'name' => 'Get Connection details',
  'description' => 'Get Connection details Official Airbyte endpoint: GET /connections/{connectionId}',
  'icon' => 'ph:database',
),
  'airbyte_patch_connection' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbytePatchConnection',
  'type' => 'write',
  'name' => 'Update Connection details',
  'description' => 'Update Connection details Official Airbyte endpoint: PATCH /connections/{connectionId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_delete_connection' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteDeleteConnection',
  'type' => 'write',
  'name' => 'Delete a Connection',
  'description' => 'Delete a Connection Official Airbyte endpoint: DELETE /connections/{connectionId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_get_stream_properties' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteGetStreamProperties',
  'type' => 'read',
  'name' => 'Get stream properties',
  'description' => 'Get stream properties Official Airbyte endpoint: GET /streams',
  'icon' => 'ph:database',
),
  'airbyte_list_workspaces' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteListWorkspaces',
  'type' => 'read',
  'name' => 'List workspaces',
  'description' => 'List workspaces Official Airbyte endpoint: GET /workspaces',
  'icon' => 'ph:database',
),
  'airbyte_create_workspace' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteCreateWorkspace',
  'type' => 'write',
  'name' => 'Create a workspace',
  'description' => 'Create a workspace Official Airbyte endpoint: POST /workspaces',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_get_workspace' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteGetWorkspace',
  'type' => 'read',
  'name' => 'Get Workspace details',
  'description' => 'Get Workspace details Official Airbyte endpoint: GET /workspaces/{workspaceId}',
  'icon' => 'ph:database',
),
  'airbyte_update_workspace' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteUpdateWorkspace',
  'type' => 'write',
  'name' => 'Update a workspace',
  'description' => 'Update a workspace Official Airbyte endpoint: PATCH /workspaces/{workspaceId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_delete_workspace' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteDeleteWorkspace',
  'type' => 'write',
  'name' => 'Delete a Workspace',
  'description' => 'Delete a Workspace Official Airbyte endpoint: DELETE /workspaces/{workspaceId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_create_or_update_workspace_oauth_credentials' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteCreateOrUpdateWorkspaceOAuthCredentials',
  'type' => 'write',
  'name' => 'Create OAuth override credentials for a workspace and source type.',
  'description' => 'Create OAuth override credentials for a workspace and source type. Official Airbyte endpoint: PUT /workspaces/{workspaceId}/oauthCredentials Create/update a set of OAuth credentials to override the Airbyte-provided OA...',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_get_permission' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteGetPermission',
  'type' => 'read',
  'name' => 'Get Permission details',
  'description' => 'Get Permission details Official Airbyte endpoint: GET /permissions/{permissionId}',
  'icon' => 'ph:database',
),
  'airbyte_update_permission' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteUpdatePermission',
  'type' => 'write',
  'name' => 'Update a permission',
  'description' => 'Update a permission Official Airbyte endpoint: PATCH /permissions/{permissionId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_delete_permission' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteDeletePermission',
  'type' => 'write',
  'name' => 'Delete a Permission',
  'description' => 'Delete a Permission Official Airbyte endpoint: DELETE /permissions/{permissionId}',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_list_permissions' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteListPermissions',
  'type' => 'read',
  'name' => 'List Permissions by user id',
  'description' => 'List Permissions by user id Official Airbyte endpoint: GET /permissions',
  'icon' => 'ph:database',
),
  'airbyte_create_permission' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteCreatePermission',
  'type' => 'write',
  'name' => 'Create a permission',
  'description' => 'Create a permission Official Airbyte endpoint: POST /permissions',
  'icon' => 'ph:pencil-simple',
),
  'airbyte_list_organizations_for_user' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteListOrganizationsForUser',
  'type' => 'read',
  'name' => 'List all organizations for a user',
  'description' => 'List all organizations for a user Official Airbyte endpoint: GET /organizations Lists users organizations.',
  'icon' => 'ph:database',
),
  'airbyte_list_users_within_an_organization' => array (
  'class' => 'OpenCompany\\Integrations\\Airbyte\\Tools\\AirbyteListUsersWithinAnOrganization',
  'type' => 'read',
  'name' => 'List all users within an organization',
  'description' => 'List all users within an organization Official Airbyte endpoint: GET /users Organization Admin user can list all users within the same organization. Also provide filtering on a list of user IDs or/and a list of user e...',
  'icon' => 'ph:database',
),
]; }
    public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); } public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/airbyte.md'; }
    /** @param  array<string, mixed>  $context  Optional account context from the host. */ private function resolveService(array $context = []): AirbyteService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new AirbyteService(accessToken:$creds->get('airbyte','access_token','',$account), baseUrl:$creds->get('airbyte','url','https://api.airbyte.com/v1',$account));} return app(AirbyteService::class); }
}
