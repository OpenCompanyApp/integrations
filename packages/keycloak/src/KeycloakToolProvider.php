<?php

namespace OpenCompany\Integrations\Keycloak;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Keycloak.
 *
 * Exposes the official Keycloak Admin REST API operation set for realms, users,
 * clients, groups, roles, identity providers, sessions, events, and components.
 */
class KeycloakToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'bearer_token','legacy_auth_type'=>'api_token','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Use a Keycloak admin access token with permissions for the target realm.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'keycloak'; } public function appMeta(): array { return ['label'=>'Keycloak','description'=>'Identity and access management administration','icon'=>'ph:key','logo'=>'simple-icons:keycloak']; }
    public function integrationMeta(): array { return ['name'=>'Keycloak','description'=>'Manage Keycloak realms, users, clients, groups, roles, identity providers, events, sessions, and components through the Admin REST API.','icon'=>'ph:key','logo'=>'simple-icons:keycloak','category'=>'productivity','badge'=>'verified','docs_url'=>'https://www.keycloak.org/docs-api/latest/rest-api/','source_url'=>'https://www.keycloak.org/docs-api/latest/rest-api/openapi.json']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Admin Access Token','required'=>true],['key'=>'base_url','type'=>'url','label'=>'Keycloak Base URL','default'=>'https://keycloak.example.test','required'=>true],['key'=>'realm','type'=>'text','label'=>'Default Realm','placeholder'=>'master','required'=>false]]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $token=(string)($config['access_token']??''); $baseUrl=rtrim((string)($config['base_url']??'https://keycloak.example.test'),'/'); $realm=(string)($config['realm']??''); if($token==='') return ['success'=>false,'error'=>'Keycloak admin access token is required.']; if($realm==='') return ['success'=>false,'error'=>'Keycloak realm is required to test the connection.']; try{$response=Http::withHeaders(['Authorization'=>'Bearer '.$token,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/admin/realms/'.rawurlencode($realm)); if(!$response->successful()) return ['success'=>false,'error'=>'Keycloak API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to Keycloak realm '.$realm.' at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['access_token'=>'required|string','base_url'=>'required|url','realm'=>'nullable|string']; } public function credentialFields(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Admin Access Token','required'=>true],['key'=>'base_url','type'=>'url','label'=>'Keycloak Base URL','required'=>true,'default'=>'https://keycloak.example.test'],['key'=>'realm','type'=>'string','label'=>'Default Realm','required'=>false]]; }
    public function tools(): array { return array (
  'keycloak_delete_admin_realms_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealm',
    'type' => 'write',
    'name' => 'Delete the realm',
    'description' => 'Delete the realm.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_admin_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmAdminEvents',
    'type' => 'write',
    'name' => 'Delete all admin events',
    'description' => 'Delete all admin events.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_attack_detection_brute_force_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmAttackDetectionBruteForceUsers',
    'type' => 'write',
    'name' => 'Clear any user login failures for all users This can release temporary disabled users',
    'description' => 'Clear any user login failures for all users This can release temporary disabled users.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_attack_detection_brute_force_users_user_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmAttackDetectionBruteForceUsersUserId',
    'type' => 'write',
    'name' => 'Clear any user login failures for the user This can release temporary disabled user',
    'description' => 'Clear any user login failures for the user This can release temporary disabled user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_authentication_config_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmAuthenticationConfigId',
    'type' => 'write',
    'name' => 'Delete authenticator configuration',
    'description' => 'Delete authenticator configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_authentication_executions_execution_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmAuthenticationExecutionsExecutionId',
    'type' => 'write',
    'name' => 'Delete execution',
    'description' => 'Delete execution.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_authentication_flows_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmAuthenticationFlowsId',
    'type' => 'write',
    'name' => 'Delete an authentication flow',
    'description' => 'Delete an authentication flow.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_authentication_required_actions_alias' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmAuthenticationRequiredActionsAlias',
    'type' => 'write',
    'name' => 'Delete required action',
    'description' => 'Delete required action.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_authentication_required_actions_alias_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmAuthenticationRequiredActionsAliasConfig',
    'type' => 'write',
    'name' => 'Delete RequiredAction configuration',
    'description' => 'Delete RequiredAction configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'Delete the client scope',
    'description' => 'Delete the client scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModelsId',
    'type' => 'write',
    'name' => 'Delete the mapper',
    'description' => 'Delete the mapper.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClient',
    'type' => 'write',
    'name' => 'Remove client-level roles from the client\'s scope',
    'description' => 'Remove client-level roles from the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealm',
    'type' => 'write',
    'name' => 'Remove a set of realm-level roles from the client\'s scope',
    'description' => 'Remove a set of realm-level roles from the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_client_templates_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeId',
    'type' => 'write',
    'name' => 'Delete the client scope',
    'description' => 'Delete the client scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModelsId',
    'type' => 'write',
    'name' => 'Delete the mapper',
    'description' => 'Delete the mapper.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClient',
    'type' => 'write',
    'name' => 'Remove client-level roles from the client\'s scope',
    'description' => 'Remove client-level roles from the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealm',
    'type' => 'write',
    'name' => 'Remove a set of realm-level roles from the client\'s scope',
    'description' => 'Remove a set of realm-level roles from the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuid',
    'type' => 'write',
    'name' => 'Delete the client',
    'description' => 'Delete the client.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
    'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
    'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_client_secret_rotated' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidClientSecretRotated',
    'type' => 'write',
    'name' => 'Invalidate the rotated secret for the client',
    'description' => 'Invalidate the rotated secret for the client.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_default_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidDefaultClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}',
    'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_nodes_node' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidNodesNode',
    'type' => 'write',
    'name' => 'Unregister a cluster node from the client',
    'description' => 'Unregister a cluster node from the client.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_optional_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidOptionalClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}',
    'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidProtocolMappersModelsId',
    'type' => 'write',
    'name' => 'Delete the mapper',
    'description' => 'Delete the mapper.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_roles_role_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidRolesRoleName',
    'type' => 'write',
    'name' => 'Delete a role by name',
    'description' => 'Delete a role by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_roles_role_name_composites' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidRolesRoleNameComposites',
    'type' => 'write',
    'name' => 'Remove roles from the role\'s composite',
    'description' => 'Remove roles from the role\'s composite.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidScopeMappingsClientsClient',
    'type' => 'write',
    'name' => 'Remove client-level roles from the client\'s scope',
    'description' => 'Remove client-level roles from the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_scope_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsClientUuidScopeMappingsRealm',
    'type' => 'write',
    'name' => 'Remove a set of realm-level roles from the client\'s scope',
    'description' => 'Remove a set of realm-level roles from the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_clients_initial_access_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmClientsInitialAccessId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/clients-initial-access/{id}',
    'description' => 'DELETE /admin/realms/{realm}/clients-initial-access/{id}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_components_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmComponentsId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/components/{id}',
    'description' => 'DELETE /admin/realms/{realm}/components/{id}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_default_default_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmDefaultDefaultClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
    'description' => 'DELETE /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_default_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmDefaultGroupsGroupId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/default-groups/{groupId}',
    'description' => 'DELETE /admin/realms/{realm}/default-groups/{groupId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_default_optional_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmDefaultOptionalClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}',
    'description' => 'DELETE /admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmEvents',
    'type' => 'write',
    'name' => 'Delete all events',
    'description' => 'Delete all events.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmGroupsGroupId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/groups/{group-id}',
    'description' => 'DELETE /admin/realms/{realm}/groups/{group-id}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_groups_group_id_role_mappings_clients_client_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId',
    'type' => 'write',
    'name' => 'Delete client-level roles from user or group role mapping',
    'description' => 'Delete client-level roles from user or group role mapping.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_groups_group_id_role_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmGroupsGroupIdRoleMappingsRealm',
    'type' => 'write',
    'name' => 'Delete realm-level role mappings',
    'description' => 'Delete realm-level role mappings.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_identity_provider_instances_alias' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmIdentityProviderInstancesAlias',
    'type' => 'write',
    'name' => 'Delete the identity provider',
    'description' => 'Delete the identity provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_identity_provider_instances_alias_mappers_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmIdentityProviderInstancesAliasMappersId',
    'type' => 'write',
    'name' => 'Delete a mapper for the identity provider',
    'description' => 'Delete a mapper for the identity provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_localization_locale' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmLocalizationLocale',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/localization/{locale}',
    'description' => 'DELETE /admin/realms/{realm}/localization/{locale}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_localization_locale_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmLocalizationLocaleKey',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/localization/{locale}/{key}',
    'description' => 'DELETE /admin/realms/{realm}/localization/{locale}/{key}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmOrganizationsOrgId',
    'type' => 'write',
    'name' => 'Deletes the organization',
    'description' => 'Deletes the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdGroupsGroupId',
    'type' => 'write',
    'name' => 'Delete the organization group',
    'description' => 'Deletes the organization group and all its subgroups',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_groups_group_id_members_user_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembersUserId',
    'type' => 'write',
    'name' => 'Remove a user from this organization group',
    'description' => 'Removes a user from this organization group. The user remains a member of the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_identity_providers_alias' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAlias',
    'type' => 'write',
    'name' => 'Removes the identity provider with the specified alias from the organization',
    'description' => 'Breaks the association between the identity provider and the organization. The provider itself is not deleted. If no provider is found, or if it is not currently associated with the org, an error response is returned',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_invitations_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdInvitationsId',
    'type' => 'write',
    'name' => 'Delete an invitation',
    'description' => 'Delete an invitation.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_members_member_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdMembersMemberId',
    'type' => 'write',
    'name' => 'Removes the user with the specified id from the organization',
    'description' => 'Breaks the association between the user and organization. The user itself is deleted in case the membership is managed, otherwise the user is not deleted. If no user is found, or if they are not a member of the organization, an error response is returned',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_roles_by_id_role_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmRolesByIdRoleId',
    'type' => 'write',
    'name' => 'Delete the role',
    'description' => 'Delete the role.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_roles_by_id_role_id_composites' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmRolesByIdRoleIdComposites',
    'type' => 'write',
    'name' => 'Remove a set of roles from the role\'s composite',
    'description' => 'Remove a set of roles from the role\'s composite.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_roles_role_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmRolesRoleName',
    'type' => 'write',
    'name' => 'Delete a role by name',
    'description' => 'Delete a role by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_roles_role_name_composites' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmRolesRoleNameComposites',
    'type' => 'write',
    'name' => 'Remove roles from the role\'s composite',
    'description' => 'Remove roles from the role\'s composite.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_sessions_session' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmSessionsSession',
    'type' => 'write',
    'name' => 'Remove a specific user session',
    'description' => 'Any client that has an admin url will also be told to invalidate this particular session.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmUsersUserId',
    'type' => 'write',
    'name' => 'Delete the user',
    'description' => 'Delete the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_consents_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmUsersUserIdConsentsClient',
    'type' => 'write',
    'name' => 'Revoke consent and offline tokens for particular client from user',
    'description' => 'Revoke consent and offline tokens for particular client from user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_credentials_credential_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmUsersUserIdCredentialsCredentialId',
    'type' => 'write',
    'name' => 'Remove a credential for a user',
    'description' => 'Remove a credential for a user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_federated_identity_provider' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmUsersUserIdFederatedIdentityProvider',
    'type' => 'write',
    'name' => 'Remove a social login provider from user',
    'description' => 'Remove a social login provider from user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmUsersUserIdGroupsGroupId',
    'type' => 'write',
    'name' => 'DELETE /admin/realms/{realm}/users/{user-id}/groups/{groupId}',
    'description' => 'DELETE /admin/realms/{realm}/users/{user-id}/groups/{groupId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_role_mappings_clients_client_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId',
    'type' => 'write',
    'name' => 'Delete client-level roles from user or group role mapping',
    'description' => 'Delete client-level roles from user or group role mapping.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_role_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmUsersUserIdRoleMappingsRealm',
    'type' => 'write',
    'name' => 'Delete realm-level role mappings',
    'description' => 'Delete realm-level role mappings.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_delete_admin_realms_realm_workflows_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakDeleteAdminRealmsRealmWorkflowsId',
    'type' => 'write',
    'name' => 'Delete workflow',
    'description' => 'Delete the workflow and its configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_get_admin_realms' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealms',
    'type' => 'read',
    'name' => 'Get accessible realms Returns a list of accessible realms. The list is filtered based on what realms the caller is allowed to view',
    'description' => 'Get accessible realms Returns a list of accessible realms. The list is filtered based on what realms the caller is allowed to view.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealm',
    'type' => 'read',
    'name' => 'Get the top-level representation of the realm It will not include nested information like User and Client representations',
    'description' => 'Get the top-level representation of the realm It will not include nested information like User and Client representations.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_admin_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAdminEvents',
    'type' => 'read',
    'name' => 'Get admin events Returns all admin events, or filters events based on URL query parameters listed here',
    'description' => 'Get admin events Returns all admin events, or filters events based on URL query parameters listed here.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_attack_detection_brute_force_users_user_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAttackDetectionBruteForceUsersUserId',
    'type' => 'read',
    'name' => 'Get status of a username in brute force detection',
    'description' => 'Get status of a username in brute force detection.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_authenticator_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationAuthenticatorProviders',
    'type' => 'read',
    'name' => 'Get authenticator providers Returns a stream of authenticator providers',
    'description' => 'Get authenticator providers Returns a stream of authenticator providers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_client_authenticator_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationClientAuthenticatorProviders',
    'type' => 'read',
    'name' => 'Get client authenticator providers Returns a stream of client authenticator providers',
    'description' => 'Get client authenticator providers Returns a stream of client authenticator providers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_config_description_provider_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationConfigDescriptionProviderId',
    'type' => 'read',
    'name' => 'Get authenticator provider\'s configuration description',
    'description' => 'Get authenticator provider\'s configuration description.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_config_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationConfigId',
    'type' => 'read',
    'name' => 'Get authenticator configuration',
    'description' => 'Get authenticator configuration.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_executions_execution_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationExecutionsExecutionId',
    'type' => 'read',
    'name' => 'Get Single Execution',
    'description' => 'Get Single Execution.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_executions_execution_id_config_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationExecutionsExecutionIdConfigId',
    'type' => 'read',
    'name' => 'Get execution\'s configuration',
    'description' => 'Get execution\'s configuration.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_flows' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationFlows',
    'type' => 'read',
    'name' => 'Get authentication flows Returns a stream of authentication flows',
    'description' => 'Get authentication flows Returns a stream of authentication flows.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_flows_flow_alias_executions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationFlowsFlowAliasExecutions',
    'type' => 'read',
    'name' => 'Get authentication executions for a flow',
    'description' => 'Get authentication executions for a flow.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_flows_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationFlowsId',
    'type' => 'read',
    'name' => 'Get authentication flow for id',
    'description' => 'Get authentication flow for id.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_form_action_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationFormActionProviders',
    'type' => 'read',
    'name' => 'Get form action providers Returns a stream of form action providers',
    'description' => 'Get form action providers Returns a stream of form action providers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_form_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationFormProviders',
    'type' => 'read',
    'name' => 'Get form providers Returns a stream of form providers',
    'description' => 'Get form providers Returns a stream of form providers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_per_client_config_description' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationPerClientConfigDescription',
    'type' => 'read',
    'name' => 'Get configuration descriptions for all clients',
    'description' => 'Get configuration descriptions for all clients.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_required_actions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationRequiredActions',
    'type' => 'read',
    'name' => 'Get required actions Returns a stream of required actions',
    'description' => 'Get required actions Returns a stream of required actions.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_required_actions_alias' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAlias',
    'type' => 'read',
    'name' => 'Get required action for alias',
    'description' => 'Get required action for alias.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_required_actions_alias_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAliasConfig',
    'type' => 'read',
    'name' => 'Get RequiredAction configuration',
    'description' => 'Get RequiredAction configuration.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_required_actions_alias_config_description' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAliasConfigDescription',
    'type' => 'read',
    'name' => 'Get RequiredAction provider configuration description',
    'description' => 'Get RequiredAction provider configuration description.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_authentication_unregistered_required_actions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmAuthenticationUnregisteredRequiredActions',
    'type' => 'read',
    'name' => 'Get unregistered required actions Returns a stream of unregistered required actions',
    'description' => 'Get unregistered required actions Returns a stream of unregistered required actions.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_policies_policies' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientPoliciesPolicies',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/client-policies/policies',
    'description' => 'GET /admin/realms/{realm}/client-policies/policies.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_policies_profiles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientPoliciesProfiles',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/client-policies/profiles',
    'description' => 'GET /admin/realms/{realm}/client-policies/profiles.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_registration_policy_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientRegistrationPolicyProviders',
    'type' => 'read',
    'name' => 'Base path for retrieve providers with the configProperties properly filled',
    'description' => 'Base path for retrieve providers with the configProperties properly filled.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopes',
    'type' => 'read',
    'name' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm',
    'description' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeId',
    'type' => 'read',
    'name' => 'Get representation of the client scope',
    'description' => 'Get representation of the client scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModels',
    'type' => 'read',
    'name' => 'Get mappers',
    'description' => 'Get mappers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModelsId',
    'type' => 'read',
    'name' => 'Get mapper by id',
    'description' => 'Get mapper by id.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_protocol_protocol' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersProtocolProtocol',
    'type' => 'read',
    'name' => 'Get mappers by name for a specific protocol',
    'description' => 'Get mappers by name for a specific protocol.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappings',
    'type' => 'read',
    'name' => 'Get all scope mappings for the client',
    'description' => 'Get all scope mappings for the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClient',
    'type' => 'read',
    'name' => 'Get the roles associated with a client\'s scope Returns roles for the client',
    'description' => 'Get the roles associated with a client\'s scope Returns roles for the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClientAvailable',
    'type' => 'read',
    'name' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope',
    'description' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClientComposite',
    'type' => 'read',
    'name' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope',
    'description' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealm',
    'type' => 'read',
    'name' => 'Get realm-level roles associated with the client\'s scope',
    'description' => 'Get realm-level roles associated with the client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealmAvailable',
    'type' => 'read',
    'name' => 'Get realm-level roles that are available to attach to this client\'s scope',
    'description' => 'Get realm-level roles that are available to attach to this client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealmComposite',
    'type' => 'read',
    'name' => 'Get effective realm-level roles associated with the client’s scope What this does is recurse any composite roles associated with the client’s scope and adds the roles to this lists',
    'description' => 'The method is really to show a comprehensive total view of realm-level roles associated with the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_session_stats' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientSessionStats',
    'type' => 'read',
    'name' => 'Get client session stats Returns a JSON map',
    'description' => 'The key is the client id, the value is the number of sessions that currently are active with that client. Only clients that actually have a session associated with them will be in this map.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplates',
    'type' => 'read',
    'name' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm',
    'description' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeId',
    'type' => 'read',
    'name' => 'Get representation of the client scope',
    'description' => 'Get representation of the client scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModels',
    'type' => 'read',
    'name' => 'Get mappers',
    'description' => 'Get mappers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModelsId',
    'type' => 'read',
    'name' => 'Get mapper by id',
    'description' => 'Get mapper by id.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_protocol_protocol' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersProtocolProtocol',
    'type' => 'read',
    'name' => 'Get mappers by name for a specific protocol',
    'description' => 'Get mappers by name for a specific protocol.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappings',
    'type' => 'read',
    'name' => 'Get all scope mappings for the client',
    'description' => 'Get all scope mappings for the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClient',
    'type' => 'read',
    'name' => 'Get the roles associated with a client\'s scope Returns roles for the client',
    'description' => 'Get the roles associated with a client\'s scope Returns roles for the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClientAvailable',
    'type' => 'read',
    'name' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope',
    'description' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClientComposite',
    'type' => 'read',
    'name' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope',
    'description' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealm',
    'type' => 'read',
    'name' => 'Get realm-level roles associated with the client\'s scope',
    'description' => 'Get realm-level roles associated with the client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealmAvailable',
    'type' => 'read',
    'name' => 'Get realm-level roles that are available to attach to this client\'s scope',
    'description' => 'Get realm-level roles that are available to attach to this client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealmComposite',
    'type' => 'read',
    'name' => 'Get effective realm-level roles associated with the client’s scope What this does is recurse any composite roles associated with the client’s scope and adds the roles to this lists',
    'description' => 'The method is really to show a comprehensive total view of realm-level roles associated with the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_client_types' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientTypes',
    'type' => 'read',
    'name' => 'List all client types available in the current realm',
    'description' => 'This endpoint returns a list of both global and realm level client types and the attributes they set',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClients',
    'type' => 'read',
    'name' => 'Get clients belonging to the realm',
    'description' => 'If a client can’t be retrieved from the storage due to a problem with the underlying storage, it is silently removed from the returned list. This ensures that concurrent modifications to the list don’t prevent callers from retrieving this list.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuid',
    'type' => 'read',
    'name' => 'Get representation of the client',
    'description' => 'Get representation of the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServer',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermission',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionProviders',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_search' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionSearch',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicy',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicyProviders',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/providers',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/providers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy_search' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicySearch',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/search',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/search.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResource',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceId',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id_attributes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceIdAttributes',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/attributes',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/attributes.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceIdPermissions',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/permissions',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/permissions.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceIdScopes',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/scopes',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/scopes.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_search' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceSearch',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScope',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeIdPermissions',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id_resources' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeIdResources',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/resources',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/resources.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_search' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeSearch',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/search',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/search.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_settings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerSettings',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_certificates_attr' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidCertificatesAttr',
    'type' => 'read',
    'name' => 'Get key info',
    'description' => 'Get key info.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_client_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidClientSecret',
    'type' => 'read',
    'name' => 'Get the client secret',
    'description' => 'Get the client secret.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_client_secret_rotated' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidClientSecretRotated',
    'type' => 'read',
    'name' => 'Get the rotated client secret',
    'description' => 'Get the rotated client secret.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_default_client_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidDefaultClientScopes',
    'type' => 'read',
    'name' => 'Get default client scopes. Only name and ids are returned',
    'description' => 'Get default client scopes. Only name and ids are returned.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_access_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesGenerateExampleAccessToken',
    'type' => 'read',
    'name' => 'Create JSON with payload of example access token',
    'description' => 'Create JSON with payload of example access token.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_id_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesGenerateExampleIdToken',
    'type' => 'read',
    'name' => 'Create JSON with payload of example id token',
    'description' => 'Create JSON with payload of example id token.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_userinfo' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesGenerateExampleUserinfo',
    'type' => 'read',
    'name' => 'Create JSON with payload of example user info',
    'description' => 'Create JSON with payload of example user info.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_protocol_mappers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesProtocolMappers',
    'type' => 'read',
    'name' => 'Return list of all protocol mappers, which will be used when generating tokens issued for particular client',
    'description' => 'This means protocol mappers assigned to this client directly and protocol mappers assigned to all client scopes of this client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_scope_mappings_role_container_id_granted' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesScopeMappingsRoleContainerIdGranted',
    'type' => 'read',
    'name' => 'Get effective scope mapping of all roles of particular role container, which this client is defacto allowed to have in the accessToken issued for him',
    'description' => 'This contains scope mappings, which this client has directly, as well as scope mappings, which are granted to all client scopes, which are linked with this client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_scope_mappings_role_container_id_not_granted' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesScopeMappingsRoleContainerIdNotGranted',
    'type' => 'read',
    'name' => 'Get roles, which this client doesn\'t have scope for and can\'t have them in the accessToken issued for him',
    'description' => 'Defacto all the other roles of particular role container, which are not in {@link #getGrantedScopeMappings()}',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_installation_providers_provider_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidInstallationProvidersProviderId',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId}',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId}.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidManagementPermissions',
    'type' => 'read',
    'name' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_offline_session_count' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidOfflineSessionCount',
    'type' => 'read',
    'name' => 'Get application offline session count Returns a number of offline user sessions associated with this client { "count": number }',
    'description' => 'Get application offline session count Returns a number of offline user sessions associated with this client { "count": number }.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_offline_sessions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidOfflineSessions',
    'type' => 'read',
    'name' => 'Get offline sessions for client Returns a list of offline user sessions associated with this client',
    'description' => 'Get offline sessions for client Returns a list of offline user sessions associated with this client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_optional_client_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidOptionalClientScopes',
    'type' => 'read',
    'name' => 'Get optional client scopes. Only name and ids are returned',
    'description' => 'Get optional client scopes. Only name and ids are returned.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidProtocolMappersModels',
    'type' => 'read',
    'name' => 'Get mappers',
    'description' => 'Get mappers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidProtocolMappersModelsId',
    'type' => 'read',
    'name' => 'Get mapper by id',
    'description' => 'Get mapper by id.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_protocol_protocol' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidProtocolMappersProtocolProtocol',
    'type' => 'read',
    'name' => 'Get mappers by name for a specific protocol',
    'description' => 'Get mappers by name for a specific protocol.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidRoles',
    'type' => 'read',
    'name' => 'Get all roles for the realm or client',
    'description' => 'Get all roles for the realm or client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleName',
    'type' => 'read',
    'name' => 'Get a role by name',
    'description' => 'Get a role by name.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameComposites',
    'type' => 'read',
    'name' => 'Get composites of the role',
    'description' => 'Get composites of the role.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites_clients_target_client_uuid' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameCompositesClientsTargetClientUuid',
    'type' => 'read',
    'name' => 'Get client-level roles for the client that are in the role\'s composite',
    'description' => 'Get client-level roles for the client that are in the role\'s composite.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameCompositesRealm',
    'type' => 'read',
    'name' => 'Get realm-level roles of the role\'s composite',
    'description' => 'Get realm-level roles of the role\'s composite.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameGroups',
    'type' => 'read',
    'name' => 'Returns a stream of groups that have the specified role name',
    'description' => 'Returns a stream of groups that have the specified role name.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameManagementPermissions',
    'type' => 'read',
    'name' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameUsers',
    'type' => 'read',
    'name' => 'Returns a stream of users that have the specified role name',
    'description' => 'Returns a stream of users that have the specified role name.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappings',
    'type' => 'read',
    'name' => 'Get all scope mappings for the client',
    'description' => 'Get all scope mappings for the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClient',
    'type' => 'read',
    'name' => 'Get the roles associated with a client\'s scope Returns roles for the client',
    'description' => 'Get the roles associated with a client\'s scope Returns roles for the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClientAvailable',
    'type' => 'read',
    'name' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope',
    'description' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClientComposite',
    'type' => 'read',
    'name' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope',
    'description' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealm',
    'type' => 'read',
    'name' => 'Get realm-level roles associated with the client\'s scope',
    'description' => 'Get realm-level roles associated with the client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealmAvailable',
    'type' => 'read',
    'name' => 'Get realm-level roles that are available to attach to this client\'s scope',
    'description' => 'Get realm-level roles that are available to attach to this client\'s scope.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealmComposite',
    'type' => 'read',
    'name' => 'Get effective realm-level roles associated with the client’s scope What this does is recurse any composite roles associated with the client’s scope and adds the roles to this lists',
    'description' => 'The method is really to show a comprehensive total view of realm-level roles associated with the client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_service_account_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidServiceAccountUser',
    'type' => 'read',
    'name' => 'Get a user dedicated to the service account',
    'description' => 'Get a user dedicated to the service account.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_session_count' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidSessionCount',
    'type' => 'read',
    'name' => 'Get application session count Returns a number of user sessions associated with this client { "count": number }',
    'description' => 'Get application session count Returns a number of user sessions associated with this client { "count": number }.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_test_nodes_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidTestNodesAvailable',
    'type' => 'read',
    'name' => 'Test if registered cluster nodes are available Tests availability by sending \'ping\' request to all cluster nodes',
    'description' => 'Test if registered cluster nodes are available Tests availability by sending \'ping\' request to all cluster nodes.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_user_sessions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsClientUuidUserSessions',
    'type' => 'read',
    'name' => 'Get user sessions for client Returns a list of user sessions associated with this client',
    'description' => 'Get user sessions for client Returns a list of user sessions associated with this client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_clients_initial_access' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmClientsInitialAccess',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/clients-initial-access',
    'description' => 'GET /admin/realms/{realm}/clients-initial-access.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_components' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmComponents',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/components',
    'description' => 'GET /admin/realms/{realm}/components.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_components_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmComponentsId',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/components/{id}',
    'description' => 'GET /admin/realms/{realm}/components/{id}.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_components_id_sub_component_types' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmComponentsIdSubComponentTypes',
    'type' => 'read',
    'name' => 'List of subcomponent types that are available to configure for a particular parent component',
    'description' => 'List of subcomponent types that are available to configure for a particular parent component.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_credential_registrators' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmCredentialRegistrators',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/credential-registrators',
    'description' => 'GET /admin/realms/{realm}/credential-registrators.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_default_default_client_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmDefaultDefaultClientScopes',
    'type' => 'read',
    'name' => 'Get realm default client scopes. Only name and ids are returned',
    'description' => 'Get realm default client scopes. Only name and ids are returned.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_default_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmDefaultGroups',
    'type' => 'read',
    'name' => 'Get group hierarchy. Only name and ids are returned',
    'description' => 'Get group hierarchy. Only name and ids are returned.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_default_optional_client_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmDefaultOptionalClientScopes',
    'type' => 'read',
    'name' => 'Get realm optional client scopes. Only name and ids are returned',
    'description' => 'Get realm optional client scopes. Only name and ids are returned.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmEvents',
    'type' => 'read',
    'name' => 'Get events Returns all events, or filters them based on URL query parameters listed here',
    'description' => 'Get events Returns all events, or filters them based on URL query parameters listed here.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_events_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmEventsConfig',
    'type' => 'read',
    'name' => 'Get the events provider configuration Returns JSON object with events provider configuration',
    'description' => 'Get the events provider configuration Returns JSON object with events provider configuration.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_group_by_path_path' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupByPathPath',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/group-by-path/{path}',
    'description' => 'GET /admin/realms/{realm}/group-by-path/{path}.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroups',
    'type' => 'read',
    'name' => 'Get group hierarchy. Only `name` and `id` are returned. `subGroups` are only returned when using the `search` or `q` parameter. If none of these parameters is provided, the top-level groups are returned without `subGroups` being filled',
    'description' => 'Get group hierarchy. Only `name` and `id` are returned. `subGroups` are only returned when using the `search` or `q` parameter. If none of these parameters is provided, the top-level groups are returned without `subGroups` being filled.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_count' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsCount',
    'type' => 'read',
    'name' => 'Returns the groups counts',
    'description' => 'Returns the groups counts.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupId',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/groups/{group-id}',
    'description' => 'GET /admin/realms/{realm}/groups/{group-id}.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_children' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdChildren',
    'type' => 'read',
    'name' => 'Return a paginated list of subgroups that have a parent group corresponding to the group on the URL',
    'description' => 'Return a paginated list of subgroups that have a parent group corresponding to the group on the URL.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdManagementPermissions',
    'type' => 'read',
    'name' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdMembers',
    'type' => 'read',
    'name' => 'Get users Returns a stream of users, filtered according to query parameters',
    'description' => 'Get users Returns a stream of users, filtered according to query parameters.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappings',
    'type' => 'read',
    'name' => 'Get role mappings',
    'description' => 'Get role mappings.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId',
    'type' => 'read',
    'name' => 'Get client-level role mappings for the user or group, and the app',
    'description' => 'Get client-level role mappings for the user or group, and the app.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientIdAvailable',
    'type' => 'read',
    'name' => 'Get available client-level roles that can be mapped to the user or group',
    'description' => 'Get available client-level roles that can be mapped to the user or group.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientIdComposite',
    'type' => 'read',
    'name' => 'Get effective client-level role mappings This recurses any composite roles',
    'description' => 'Get effective client-level role mappings This recurses any composite roles.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsRealm',
    'type' => 'read',
    'name' => 'Get realm-level role mappings',
    'description' => 'Get realm-level role mappings.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsRealmAvailable',
    'type' => 'read',
    'name' => 'Get realm-level roles that can be mapped',
    'description' => 'Get realm-level roles that can be mapped.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsRealmComposite',
    'type' => 'read',
    'name' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result',
    'description' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmIdentityProviderInstances',
    'type' => 'read',
    'name' => 'List identity providers',
    'description' => 'List identity providers.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmIdentityProviderInstancesAlias',
    'type' => 'read',
    'name' => 'Get the identity provider',
    'description' => 'Get the identity provider.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_export' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasExport',
    'type' => 'read',
    'name' => 'Export public broker configuration for identity provider',
    'description' => 'Export public broker configuration for identity provider.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasManagementPermissions',
    'type' => 'read',
    'name' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mapper_types' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMapperTypes',
    'type' => 'read',
    'name' => 'Get mapper types for identity provider',
    'description' => 'Get mapper types for identity provider.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mappers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMappers',
    'type' => 'read',
    'name' => 'Get mappers for identity provider',
    'description' => 'Get mappers for identity provider.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mappers_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMappersId',
    'type' => 'read',
    'name' => 'Get mapper by id for the identity provider',
    'description' => 'Get mapper by id for the identity provider.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_reload_keys' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasReloadKeys',
    'type' => 'read',
    'name' => 'Reaload keys for the identity provider if the provider supports it, "true" is returned if reload was performed, "false" if not',
    'description' => 'Reaload keys for the identity provider if the provider supports it, "true" is returned if reload was performed, "false" if not.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_providers_provider_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmIdentityProviderProvidersProviderId',
    'type' => 'read',
    'name' => 'Get the identity provider factory for that provider id',
    'description' => 'Get the identity provider factory for that provider id.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_keys' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmKeys',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/keys',
    'description' => 'GET /admin/realms/{realm}/keys.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_localization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmLocalization',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/localization',
    'description' => 'GET /admin/realms/{realm}/localization.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_localization_locale' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmLocalizationLocale',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/localization/{locale}',
    'description' => 'GET /admin/realms/{realm}/localization/{locale}.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_localization_locale_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmLocalizationLocaleKey',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/localization/{locale}/{key}',
    'description' => 'GET /admin/realms/{realm}/localization/{locale}/{key}.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizations',
    'type' => 'read',
    'name' => 'Returns a paginated list of organizations filtered according to the specified parameters',
    'description' => 'Returns a paginated list of organizations filtered according to the specified parameters.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_count' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsCount',
    'type' => 'read',
    'name' => 'Returns the organizations counts',
    'description' => 'Returns the organizations counts.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_members_member_id_organizations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsMembersMemberIdOrganizations',
    'type' => 'read',
    'name' => 'Returns the organizations associated with the user that has the specified id',
    'description' => 'Returns the organizations associated with the user that has the specified id.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgId',
    'type' => 'read',
    'name' => 'Returns the organization representation',
    'description' => 'Returns the organization representation.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroups',
    'type' => 'read',
    'name' => 'Get organization groups',
    'description' => 'Returns organization groups. When `search` parameter is provided, groups are searched by name. When `q` parameter is provided, groups are searched by attributes. If neither parameter is provided, top-level groups are returned.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_by_path_path' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupByPathPath',
    'type' => 'read',
    'name' => 'Get organization group by path',
    'description' => 'Returns the organization group with the specified path',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupId',
    'type' => 'read',
    'name' => 'Get organization group representation',
    'description' => 'Get organization group representation.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id_children' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdChildren',
    'type' => 'read',
    'name' => 'Get subgroups of this organization group',
    'description' => 'Returns a paginated stream of subgroups that belong to this organization group',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembers',
    'type' => 'read',
    'name' => 'Get members of this organization group',
    'description' => 'Returns a paginated list of organization members that belong to this group',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProviders',
    'type' => 'read',
    'name' => 'Returns all identity providers associated with the organization',
    'description' => 'Returns all identity providers associated with the organization.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers_alias' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAlias',
    'type' => 'read',
    'name' => 'Returns the identity provider associated with the organization that has the specified alias',
    'description' => 'Searches for an identity provider with the given alias. If one is found and is associated with the organization, it is returned. Otherwise, an error response with status NOT_FOUND is returned',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers_alias_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAliasGroups',
    'type' => 'read',
    'name' => 'Returns organization groups for the identity provider',
    'description' => 'Returns organization groups that can be used in identity provider mappers. Only returns groups if the identity provider is associated with the organization.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_invitations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdInvitations',
    'type' => 'read',
    'name' => 'Get invitations for the organization',
    'description' => 'Get invitations for the organization.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_invitations_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdInvitationsId',
    'type' => 'read',
    'name' => 'Get invitation by ID',
    'description' => 'Get invitation by ID.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembers',
    'type' => 'read',
    'name' => 'Returns a paginated list of organization members filtered according to the specified parameters',
    'description' => 'Returns a paginated list of organization members filtered according to the specified parameters.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members_count' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersCount',
    'type' => 'read',
    'name' => 'Returns number of members in the organization',
    'description' => 'Returns number of members in the organization.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberId',
    'type' => 'read',
    'name' => 'Returns the member of the organization with the specified id',
    'description' => 'Searches for auser with the given id. If one is found, and is currently a member of the organization, returns it. Otherwise,an error response with status NOT_FOUND is returned',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberIdGroups',
    'type' => 'read',
    'name' => 'Returns the organization group memberships for a member with the specified id',
    'description' => 'Searches for auser with the given id. If one is found, and is currently a member of the organization, returns the groups from the organizationwhere the user is member of. Otherwise, an error response with status NOT_FOUND is returned',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id_organizations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberIdOrganizations',
    'type' => 'read',
    'name' => 'Returns the organizations associated with the user that has the specified id',
    'description' => 'Returns the organizations associated with the user that has the specified id.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRoles',
    'type' => 'read',
    'name' => 'Get all roles for the realm or client',
    'description' => 'Get all roles for the realm or client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesByIdRoleId',
    'type' => 'read',
    'name' => 'Get a specific role\'s representation',
    'description' => 'Get a specific role\'s representation.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesByIdRoleIdComposites',
    'type' => 'read',
    'name' => 'Get role\'s children Returns a set of role\'s children provided the role is a composite',
    'description' => 'Get role\'s children Returns a set of role\'s children provided the role is a composite.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites_clients_client_uuid' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesByIdRoleIdCompositesClientsClientUuid',
    'type' => 'read',
    'name' => 'Get client-level roles for the client that are in the role\'s composite',
    'description' => 'Get client-level roles for the client that are in the role\'s composite.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesByIdRoleIdCompositesRealm',
    'type' => 'read',
    'name' => 'Get realm-level roles that are in the role\'s composite',
    'description' => 'Get realm-level roles that are in the role\'s composite.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesByIdRoleIdManagementPermissions',
    'type' => 'read',
    'name' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesRoleName',
    'type' => 'read',
    'name' => 'Get a role by name',
    'description' => 'Get a role by name.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_composites' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesRoleNameComposites',
    'type' => 'read',
    'name' => 'Get composites of the role',
    'description' => 'Get composites of the role.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_composites_clients_target_client_uuid' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesRoleNameCompositesClientsTargetClientUuid',
    'type' => 'read',
    'name' => 'Get client-level roles for the client that are in the role\'s composite',
    'description' => 'Get client-level roles for the client that are in the role\'s composite.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_composites_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesRoleNameCompositesRealm',
    'type' => 'read',
    'name' => 'Get realm-level roles of the role\'s composite',
    'description' => 'Get realm-level roles of the role\'s composite.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesRoleNameGroups',
    'type' => 'read',
    'name' => 'Returns a stream of groups that have the specified role name',
    'description' => 'Returns a stream of groups that have the specified role name.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesRoleNameManagementPermissions',
    'type' => 'read',
    'name' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmRolesRoleNameUsers',
    'type' => 'read',
    'name' => 'Returns a stream of users that have the specified role name',
    'description' => 'Returns a stream of users that have the specified role name.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsers',
    'type' => 'read',
    'name' => 'Get users Returns a stream of users, filtered according to query parameters',
    'description' => 'Returns a stream of users. Note that the \'credentials\' field in the returned UserRepresentation objects is typically not populated for performance reasons. If specific credential metadata is required, use the dedicated \'GET /admin/realms/{realm}/users/{user-id}/credentials\' endpoint.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_count' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersCount',
    'type' => 'read',
    'name' => 'Returns the number of users that match the given criteria',
    'description' => 'It can be called in three different ways. 1. Don’t specify any criteria and pass {@code null}. The number of all users within that realm will be returned. 2. If {@code search} is specified other criteria such as {@code last} will be ignored even though you set them. The {@code search} string will be matched against the first and last name, the username and the email of a user. 3. If {@code search} is unspecified but any of {@code last}, {@code first}, {@code email} or {@code username} those crit',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersManagementPermissions',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/users-management-permissions',
    'description' => 'GET /admin/realms/{realm}/users-management-permissions.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_profile' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersProfile',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/users/profile',
    'description' => 'Get the configuration for the user profile',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_profile_metadata' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersProfileMetadata',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/users/profile/metadata',
    'description' => 'Get the UserProfileMetadata from the configuration',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserId',
    'type' => 'read',
    'name' => 'Get representation of the user',
    'description' => 'Get representation of the user.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_configured_user_storage_credential_types' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdConfiguredUserStorageCredentialTypes',
    'type' => 'read',
    'name' => 'Return credential types, which are provided by the user storage where user is stored',
    'description' => 'Returned values can contain for example "password", "otp" etc. This will always return empty list for "local" users, which are not backed by any user storage',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_consents' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdConsents',
    'type' => 'read',
    'name' => 'Get consents granted by the user',
    'description' => 'Get consents granted by the user.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_credentials' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdCredentials',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/users/{user-id}/credentials',
    'description' => 'GET /admin/realms/{realm}/users/{user-id}/credentials.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_federated_identity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdFederatedIdentity',
    'type' => 'read',
    'name' => 'Get social logins associated with the user',
    'description' => 'Get social logins associated with the user.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdGroups',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/users/{user-id}/groups',
    'description' => 'GET /admin/realms/{realm}/users/{user-id}/groups.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_groups_count' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdGroupsCount',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/users/{user-id}/groups/count',
    'description' => 'GET /admin/realms/{realm}/users/{user-id}/groups/count.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_offline_sessions_client_uuid' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdOfflineSessionsClientUuid',
    'type' => 'read',
    'name' => 'Get offline sessions associated with the user and client',
    'description' => 'Get offline sessions associated with the user and client.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdRoleMappings',
    'type' => 'read',
    'name' => 'Get role mappings',
    'description' => 'Get role mappings.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId',
    'type' => 'read',
    'name' => 'Get client-level role mappings for the user or group, and the app',
    'description' => 'Get client-level role mappings for the user or group, and the app.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsClientsClientIdAvailable',
    'type' => 'read',
    'name' => 'Get available client-level roles that can be mapped to the user or group',
    'description' => 'Get available client-level roles that can be mapped to the user or group.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsClientsClientIdComposite',
    'type' => 'read',
    'name' => 'Get effective client-level role mappings This recurses any composite roles',
    'description' => 'Get effective client-level role mappings This recurses any composite roles.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealm',
    'type' => 'read',
    'name' => 'Get realm-level role mappings',
    'description' => 'Get realm-level role mappings.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm_available' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealmAvailable',
    'type' => 'read',
    'name' => 'Get realm-level roles that can be mapped',
    'description' => 'Get realm-level roles that can be mapped.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm_composite' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealmComposite',
    'type' => 'read',
    'name' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result',
    'description' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_sessions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdSessions',
    'type' => 'read',
    'name' => 'Get sessions associated with the user',
    'description' => 'Get sessions associated with the user.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_unmanaged_attributes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmUsersUserIdUnmanagedAttributes',
    'type' => 'read',
    'name' => 'GET /admin/realms/{realm}/users/{user-id}/unmanagedAttributes',
    'description' => 'GET /admin/realms/{realm}/users/{user-id}/unmanagedAttributes.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_workflows' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmWorkflows',
    'type' => 'read',
    'name' => 'List workflows',
    'description' => 'List workflows filtered by name and paginated using first and max parameters.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_workflows_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmWorkflowsId',
    'type' => 'read',
    'name' => 'Get workflow',
    'description' => 'Get the workflow representation. Optionally exclude the workflow id from the response.',
    'icon' => 'ph:key',
  ),
  'keycloak_get_admin_realms_realm_workflows_scheduled_resource_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakGetAdminRealmsRealmWorkflowsScheduledResourceId',
    'type' => 'read',
    'name' => 'List scheduled workflows for resource',
    'description' => 'Return workflows that have scheduled steps for the given resource identifier.',
    'icon' => 'ph:key',
  ),
  'keycloak_post_admin_realms' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealms',
    'type' => 'write',
    'name' => 'Import a realm. Imports a realm from a full representation of that realm',
    'description' => 'Realm name must be unique.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationConfig',
    'type' => 'write',
    'name' => 'Create new authenticator configuration',
    'description' => 'Create new authenticator configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_executions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationExecutions',
    'type' => 'write',
    'name' => 'Add new authentication execution',
    'description' => 'Add new authentication execution.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_executions_execution_id_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationExecutionsExecutionIdConfig',
    'type' => 'write',
    'name' => 'Update execution with new configuration',
    'description' => 'Update execution with new configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_executions_execution_id_lower_priority' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationExecutionsExecutionIdLowerPriority',
    'type' => 'write',
    'name' => 'Lower execution\'s priority',
    'description' => 'Lower execution\'s priority.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_executions_execution_id_raise_priority' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationExecutionsExecutionIdRaisePriority',
    'type' => 'write',
    'name' => 'Raise execution\'s priority',
    'description' => 'Raise execution\'s priority.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_flows' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationFlows',
    'type' => 'write',
    'name' => 'Create a new authentication flow',
    'description' => 'Create a new authentication flow.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_copy' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasCopy',
    'type' => 'write',
    'name' => 'Copy existing authentication flow under a new name The new name is given as \'newName\' attribute of the passed JSON object',
    'description' => 'Copy existing authentication flow under a new name The new name is given as \'newName\' attribute of the passed JSON object.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_executions_execution' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasExecutionsExecution',
    'type' => 'write',
    'name' => 'Add new authentication execution to a flow',
    'description' => 'Add new authentication execution to a flow.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_executions_flow' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasExecutionsFlow',
    'type' => 'write',
    'name' => 'Add new flow with new execution to existing flow',
    'description' => 'Add new flow with new execution to existing flow.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_register_required_action' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationRegisterRequiredAction',
    'type' => 'write',
    'name' => 'Register a new required actions',
    'description' => 'Register a new required actions.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_required_actions_alias_lower_priority' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationRequiredActionsAliasLowerPriority',
    'type' => 'write',
    'name' => 'Lower required action\'s priority',
    'description' => 'Lower required action\'s priority.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_authentication_required_actions_alias_raise_priority' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmAuthenticationRequiredActionsAliasRaisePriority',
    'type' => 'write',
    'name' => 'Raise required action\'s priority',
    'description' => 'Raise required action\'s priority.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_description_converter' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientDescriptionConverter',
    'type' => 'write',
    'name' => 'Base path for importing clients under this realm',
    'description' => 'Base path for importing clients under this realm.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_scopes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientScopes',
    'type' => 'write',
    'name' => 'Create a new client scope Client Scope’s name must be unique!',
    'description' => 'Create a new client scope Client Scope’s name must be unique!.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_add_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientScopesClientScopeIdProtocolMappersAddModels',
    'type' => 'write',
    'name' => 'Create multiple mappers',
    'description' => 'Create multiple mappers.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModels',
    'type' => 'write',
    'name' => 'Create a mapper',
    'description' => 'Create a mapper.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClient',
    'type' => 'write',
    'name' => 'Add client-level roles to the client\'s scope',
    'description' => 'Add client-level roles to the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealm',
    'type' => 'write',
    'name' => 'Add a set of realm-level roles to the client\'s scope',
    'description' => 'Add a set of realm-level roles to the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_templates' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientTemplates',
    'type' => 'write',
    'name' => 'Create a new client scope Client Scope’s name must be unique!',
    'description' => 'Create a new client scope Client Scope’s name must be unique!.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_add_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersAddModels',
    'type' => 'write',
    'name' => 'Create multiple mappers',
    'description' => 'Create multiple mappers.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModels',
    'type' => 'write',
    'name' => 'Create a mapper',
    'description' => 'Create a mapper.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClient',
    'type' => 'write',
    'name' => 'Add client-level roles to the client\'s scope',
    'description' => 'Add client-level roles to the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealm',
    'type' => 'write',
    'name' => 'Add a set of realm-level roles to the client\'s scope',
    'description' => 'Add a set of realm-level roles to the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClients',
    'type' => 'write',
    'name' => 'Create a new client Client’s client_id must be unique!',
    'description' => 'Create a new client Client’s client_id must be unique!.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_import' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerImport',
    'type' => 'write',
    'name' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_permission' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPermission',
    'type' => 'write',
    'name' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_evaluate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionEvaluate',
    'type' => 'write',
    'name' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/evaluate',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/evaluate.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_policy' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicy',
    'type' => 'write',
    'name' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_policy_evaluate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicyEvaluate',
    'type' => 'write',
    'name' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/evaluate',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/evaluate.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerResource',
    'type' => 'write',
    'name' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerScope',
    'type' => 'write',
    'name' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_download' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrDownload',
    'type' => 'write',
    'name' => 'Get a keystore file for the client, containing private key and public certificate',
    'description' => 'Get a keystore file for the client, containing private key and public certificate.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_generate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrGenerate',
    'type' => 'write',
    'name' => 'Generate a new certificate with new key pair',
    'description' => 'Generate a new certificate with new key pair.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_generate_and_download' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrGenerateAndDownload',
    'type' => 'write',
    'name' => 'Generate a new keypair and certificate, and get the private key file Generates a keypair and certificate and serves the private key in a specified keystore format. Only generated public certificate is saved in Keycloak DB - the private key is not',
    'description' => 'Generate a new keypair and certificate, and get the private key file Generates a keypair and certificate and serves the private key in a specified keystore format. Only generated public certificate is saved in Keycloak DB - the private key is not.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_upload' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrUpload',
    'type' => 'write',
    'name' => 'Upload certificate and eventually private key',
    'description' => 'Upload certificate and eventually private key.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_upload_certificate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrUploadCertificate',
    'type' => 'write',
    'name' => 'Upload only certificate, not private key',
    'description' => 'Upload only certificate, not private key.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_client_secret' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidClientSecret',
    'type' => 'write',
    'name' => 'Generate a new secret for the client',
    'description' => 'Generate a new secret for the client.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_nodes' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidNodes',
    'type' => 'write',
    'name' => 'Register a cluster node with the client Manually register cluster node to this client - usually it’s not needed to call this directly as adapter should handle by sending registration request to Keycloak',
    'description' => 'Register a cluster node with the client Manually register cluster node to this client - usually it’s not needed to call this directly as adapter should handle by sending registration request to Keycloak.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_protocol_mappers_add_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidProtocolMappersAddModels',
    'type' => 'write',
    'name' => 'Create multiple mappers',
    'description' => 'Create multiple mappers.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_protocol_mappers_models' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidProtocolMappersModels',
    'type' => 'write',
    'name' => 'Create a mapper',
    'description' => 'Create a mapper.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_push_revocation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidPushRevocation',
    'type' => 'write',
    'name' => 'Push the client\'s revocation policy to its admin URL If the client has an admin URL, push revocation policy to it',
    'description' => 'Push the client\'s revocation policy to its admin URL If the client has an admin URL, push revocation policy to it.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_registration_access_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidRegistrationAccessToken',
    'type' => 'write',
    'name' => 'Generate a new registration access token for the client',
    'description' => 'Generate a new registration access token for the client.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidRoles',
    'type' => 'write',
    'name' => 'Create a new role for the realm or client',
    'description' => 'Create a new role for the realm or client.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_roles_role_name_composites' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidRolesRoleNameComposites',
    'type' => 'write',
    'name' => 'Add a composite to the role',
    'description' => 'Add a composite to the role.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidScopeMappingsClientsClient',
    'type' => 'write',
    'name' => 'Add client-level roles to the client\'s scope',
    'description' => 'Add client-level roles to the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_scope_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsClientUuidScopeMappingsRealm',
    'type' => 'write',
    'name' => 'Add a set of realm-level roles to the client\'s scope',
    'description' => 'Add a set of realm-level roles to the client\'s scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_clients_initial_access' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmClientsInitialAccess',
    'type' => 'write',
    'name' => 'Create a new initial access token',
    'description' => 'Create a new initial access token.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_components' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmComponents',
    'type' => 'write',
    'name' => 'POST /admin/realms/{realm}/components',
    'description' => 'POST /admin/realms/{realm}/components.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmGroups',
    'type' => 'write',
    'name' => 'create or add a top level realm groupSet or create child',
    'description' => 'This will update the group and set the parent if it exists. Create it and set the parent if the group doesn’t exist.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_groups_group_id_children' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmGroupsGroupIdChildren',
    'type' => 'write',
    'name' => 'Set or create child',
    'description' => 'This will just set the parent if it exists. Create it and set the parent if the group doesn’t exist.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_groups_group_id_role_mappings_clients_client_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId',
    'type' => 'write',
    'name' => 'Add client-level roles to the user or group role mapping',
    'description' => 'Add client-level roles to the user or group role mapping.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_groups_group_id_role_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmGroupsGroupIdRoleMappingsRealm',
    'type' => 'write',
    'name' => 'Add realm-level role mappings to the user',
    'description' => 'Add realm-level role mappings to the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_identity_provider_import_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmIdentityProviderImportConfig',
    'type' => 'write',
    'name' => 'Import identity provider from JSON body',
    'description' => 'Import identity provider from uploaded JSON file',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_identity_provider_instances' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmIdentityProviderInstances',
    'type' => 'write',
    'name' => 'Create a new identity provider',
    'description' => 'Create a new identity provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_identity_provider_instances_alias_mappers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmIdentityProviderInstancesAliasMappers',
    'type' => 'write',
    'name' => 'Add a mapper to identity provider',
    'description' => 'Add a mapper to identity provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_identity_provider_upload_certificate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmIdentityProviderUploadCertificate',
    'type' => 'write',
    'name' => 'Uploads a certificate, prepares the jwks or public key associated, and returns the certificate representation',
    'description' => 'Uploads a certificate, prepares the jwks or public key associated, and returns the certificate representation.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_localization_locale' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmLocalizationLocale',
    'type' => 'write',
    'name' => 'Import localization from uploaded JSON file',
    'description' => 'Import localization from uploaded JSON file.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_logout_all' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmLogoutAll',
    'type' => 'write',
    'name' => 'Removes all user sessions',
    'description' => 'Any client that has an admin url will also be told to invalidate any sessions they have.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_organizations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmOrganizations',
    'type' => 'write',
    'name' => 'Creates a new organization',
    'description' => 'Creates a new organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmOrganizationsOrgIdGroups',
    'type' => 'write',
    'name' => 'Creates a new top-level group or moves an existing group to top-level',
    'description' => 'Creates a new top-level group in the organization. If the group representation includes an ID, moves the existing organization group to be a top-level group. If no ID is provided, creates a new top-level group.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_groups_group_id_children' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdChildren',
    'type' => 'write',
    'name' => 'Create or move a subgroup',
    'description' => 'Creates a new subgroup under this organization group. If the group representation includes an ID, moves the existing group to be a child of this group. If no ID is provided, creates a new subgroup.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_identity_providers' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmOrganizationsOrgIdIdentityProviders',
    'type' => 'write',
    'name' => 'Adds the identity provider with the specified id to the organization',
    'description' => 'Adds, or associates, an existing identity provider with the organization. If no identity provider is found, or if it is already associated with the organization, an error response is returned',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_invitations_id_resend' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmOrganizationsOrgIdInvitationsIdResend',
    'type' => 'write',
    'name' => 'Resend an invitation',
    'description' => 'Resend an invitation.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembers',
    'type' => 'write',
    'name' => 'Adds the user with the specified id as a member of the organization',
    'description' => 'Adds, or associates, an existing user with the organization. If no user is found, or if it is already associated with the organization, an error response is returned',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_members_invite_existing_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembersInviteExistingUser',
    'type' => 'write',
    'name' => 'Invites an existing user to the organization, using the specified user id',
    'description' => 'Invites an existing user to the organization, using the specified user id.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_members_invite_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembersInviteUser',
    'type' => 'write',
    'name' => 'Invites an existing user or sends a registration link to a new user, based on the provided e-mail address',
    'description' => 'If the user with the given e-mail address exists, it sends an invitation link, otherwise it sends a registration link.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_partial_export' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmPartialExport',
    'type' => 'write',
    'name' => 'Partial export of existing realm into a JSON file',
    'description' => 'Partial export of existing realm into a JSON file.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_partial_import' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmPartialImport',
    'type' => 'write',
    'name' => 'Partial import from a JSON file to an existing realm',
    'description' => 'Partial import from a JSON file to an existing realm.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_push_revocation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmPushRevocation',
    'type' => 'write',
    'name' => 'Push the realm\'s revocation policy to any client that has an admin url associated with it',
    'description' => 'Push the realm\'s revocation policy to any client that has an admin url associated with it.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_roles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmRoles',
    'type' => 'write',
    'name' => 'Create a new role for the realm or client',
    'description' => 'Create a new role for the realm or client.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_roles_by_id_role_id_composites' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmRolesByIdRoleIdComposites',
    'type' => 'write',
    'name' => 'Make the role a composite role by associating some child roles',
    'description' => 'Make the role a composite role by associating some child roles.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_roles_role_name_composites' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmRolesRoleNameComposites',
    'type' => 'write',
    'name' => 'Add a composite to the role',
    'description' => 'Add a composite to the role.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_test_smtpconnection' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmTestSmtpconnection',
    'type' => 'write',
    'name' => 'Test SMTP connection with current logged in user',
    'description' => 'Test SMTP connection with current logged in user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmUsers',
    'type' => 'write',
    'name' => 'Create a new user Username must be unique',
    'description' => 'Create a new user Username must be unique.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_credentials_credential_id_move_after_new_previous_credential_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmUsersUserIdCredentialsCredentialIdMoveAfterNewPreviousCredentialId',
    'type' => 'write',
    'name' => 'Move a credential to a position behind another credential',
    'description' => 'Move a credential to a position behind another credential.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_credentials_credential_id_move_to_first' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmUsersUserIdCredentialsCredentialIdMoveToFirst',
    'type' => 'write',
    'name' => 'Move a credential to a first position in the credentials list of the user',
    'description' => 'Move a credential to a first position in the credentials list of the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_federated_identity_provider' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmUsersUserIdFederatedIdentityProvider',
    'type' => 'write',
    'name' => 'Add a social login provider to the user',
    'description' => 'Add a social login provider to the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_impersonation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmUsersUserIdImpersonation',
    'type' => 'write',
    'name' => 'Impersonate the user',
    'description' => 'Impersonate the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_logout' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmUsersUserIdLogout',
    'type' => 'write',
    'name' => 'Remove all user sessions associated with the user Also send notification to all clients that have an admin URL to invalidate the sessions for the particular user',
    'description' => 'Remove all user sessions associated with the user Also send notification to all clients that have an admin URL to invalidate the sessions for the particular user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_role_mappings_clients_client_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId',
    'type' => 'write',
    'name' => 'Add client-level roles to the user or group role mapping',
    'description' => 'Add client-level roles to the user or group role mapping.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_role_mappings_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmUsersUserIdRoleMappingsRealm',
    'type' => 'write',
    'name' => 'Add realm-level role mappings to the user',
    'description' => 'Add realm-level role mappings to the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_workflows' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmWorkflows',
    'type' => 'write',
    'name' => 'Create workflow',
    'description' => 'Create a new workflow from the provided representation.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_workflows_id_activate_type_resource_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmWorkflowsIdActivateTypeResourceId',
    'type' => 'write',
    'name' => 'Activate workflow for resource',
    'description' => 'Activate the workflow for the given resource type and identifier. Optionally schedule the first step using the notBefore parameter.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_workflows_id_deactivate_type_resource_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmWorkflowsIdDeactivateTypeResourceId',
    'type' => 'write',
    'name' => 'Deactivate workflow for resource',
    'description' => 'Deactivate the workflow for the given resource type and identifier.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_post_admin_realms_realm_workflows_migrate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPostAdminRealmsRealmWorkflowsMigrate',
    'type' => 'write',
    'name' => 'Migrate scheduled resources from one step to another',
    'description' => 'Migrate scheduled resources from one step to another step in the same or in a different workflow.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealm',
    'type' => 'write',
    'name' => 'Update the top-level information of the realm Any user, roles or client information in the representation will be ignored',
    'description' => 'This will only update top-level attributes of the realm.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_authentication_config_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmAuthenticationConfigId',
    'type' => 'write',
    'name' => 'Update authenticator configuration',
    'description' => 'Update authenticator configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_authentication_flows_flow_alias_executions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmAuthenticationFlowsFlowAliasExecutions',
    'type' => 'write',
    'name' => 'Update authentication executions of a Flow',
    'description' => 'Update authentication executions of a Flow.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_authentication_flows_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmAuthenticationFlowsId',
    'type' => 'write',
    'name' => 'Update an authentication flow',
    'description' => 'Update an authentication flow.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_authentication_required_actions_alias' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmAuthenticationRequiredActionsAlias',
    'type' => 'write',
    'name' => 'Update required action',
    'description' => 'Update required action.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_authentication_required_actions_alias_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmAuthenticationRequiredActionsAliasConfig',
    'type' => 'write',
    'name' => 'Update RequiredAction configuration',
    'description' => 'Update RequiredAction configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_client_policies_policies' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientPoliciesPolicies',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/client-policies/policies',
    'description' => 'PUT /admin/realms/{realm}/client-policies/policies.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_client_policies_profiles' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientPoliciesProfiles',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/client-policies/profiles',
    'description' => 'PUT /admin/realms/{realm}/client-policies/profiles.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'Update the client scope',
    'description' => 'Update the client scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModelsId',
    'type' => 'write',
    'name' => 'Update the mapper',
    'description' => 'Update the mapper.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_client_templates_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientTemplatesClientScopeId',
    'type' => 'write',
    'name' => 'Update the client scope',
    'description' => 'Update the client scope.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModelsId',
    'type' => 'write',
    'name' => 'Update the mapper',
    'description' => 'Update the mapper.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_client_types' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientTypes',
    'type' => 'write',
    'name' => 'Update a client type',
    'description' => 'This endpoint allows you to update a realm level client type',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuid',
    'type' => 'write',
    'name' => 'Update the client',
    'description' => 'Update the client.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServer',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceId',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_default_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuidDefaultClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuidManagementPermissions',
    'type' => 'write',
    'name' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_optional_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuidOptionalClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuidProtocolMappersModelsId',
    'type' => 'write',
    'name' => 'Update the mapper',
    'description' => 'Update the mapper.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_roles_role_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuidRolesRoleName',
    'type' => 'write',
    'name' => 'Update a role by name',
    'description' => 'Update a role by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_roles_role_name_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmClientsClientUuidRolesRoleNameManagementPermissions',
    'type' => 'write',
    'name' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_components_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmComponentsId',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/components/{id}',
    'description' => 'PUT /admin/realms/{realm}/components/{id}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_default_default_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmDefaultDefaultClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
    'description' => 'PUT /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_default_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmDefaultGroupsGroupId',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/default-groups/{groupId}',
    'description' => 'PUT /admin/realms/{realm}/default-groups/{groupId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_default_optional_client_scopes_client_scope_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmDefaultOptionalClientScopesClientScopeId',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}',
    'description' => 'PUT /admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_events_config' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmEventsConfig',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/events/config',
    'description' => 'Update the events provider Change the events provider and/or its configuration',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmGroupsGroupId',
    'type' => 'write',
    'name' => 'Update group, ignores subgroups',
    'description' => 'Update group, ignores subgroups.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_groups_group_id_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmGroupsGroupIdManagementPermissions',
    'type' => 'write',
    'name' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_identity_provider_instances_alias' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmIdentityProviderInstancesAlias',
    'type' => 'write',
    'name' => 'Update the identity provider',
    'description' => 'Update the identity provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_identity_provider_instances_alias_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmIdentityProviderInstancesAliasManagementPermissions',
    'type' => 'write',
    'name' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_identity_provider_instances_alias_mappers_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmIdentityProviderInstancesAliasMappersId',
    'type' => 'write',
    'name' => 'Update a mapper for the identity provider',
    'description' => 'Update a mapper for the identity provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_localization_locale_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmLocalizationLocaleKey',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/localization/{locale}/{key}',
    'description' => 'PUT /admin/realms/{realm}/localization/{locale}/{key}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_organizations_org_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmOrganizationsOrgId',
    'type' => 'write',
    'name' => 'Updates the organization',
    'description' => 'Updates the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_organizations_org_id_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmOrganizationsOrgIdGroupsGroupId',
    'type' => 'write',
    'name' => 'Update organization group',
    'description' => 'Updates the organization group\'s name, description, and attributes. Subgroups are not affected.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_organizations_org_id_groups_group_id_members_user_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembersUserId',
    'type' => 'write',
    'name' => 'Add a user to this organization group',
    'description' => 'Adds an organization member to this group. The user must be a member of the organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_roles_by_id_role_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmRolesByIdRoleId',
    'type' => 'write',
    'name' => 'Update the role',
    'description' => 'Update the role.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_roles_by_id_role_id_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmRolesByIdRoleIdManagementPermissions',
    'type' => 'write',
    'name' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_roles_role_name' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmRolesRoleName',
    'type' => 'write',
    'name' => 'Update a role by name',
    'description' => 'Update a role by name.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_roles_role_name_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmRolesRoleNameManagementPermissions',
    'type' => 'write',
    'name' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_management_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersManagementPermissions',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/users-management-permissions',
    'description' => 'PUT /admin/realms/{realm}/users-management-permissions.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_profile' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersProfile',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/users/profile',
    'description' => 'Set the configuration for the user profile',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_user_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersUserId',
    'type' => 'write',
    'name' => 'Update the user',
    'description' => 'Update the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_credentials_credential_id_user_label' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersUserIdCredentialsCredentialIdUserLabel',
    'type' => 'write',
    'name' => 'Update a credential label for a user',
    'description' => 'Update a credential label for a user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_disable_credential_types' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersUserIdDisableCredentialTypes',
    'type' => 'write',
    'name' => 'Disable all credentials for a user of a specific type',
    'description' => 'Disable all credentials for a user of a specific type.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_execute_actions_email' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersUserIdExecuteActionsEmail',
    'type' => 'write',
    'name' => 'Send an email to the user with a link they can click to execute particular actions',
    'description' => 'An email contains a link the user can click to perform a set of required actions. The redirectUri and clientId parameters are optional. If no redirect is given, then there will be no link back to click after actions have completed. Redirect uri must be a valid uri for the particular clientId.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_groups_group_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersUserIdGroupsGroupId',
    'type' => 'write',
    'name' => 'PUT /admin/realms/{realm}/users/{user-id}/groups/{groupId}',
    'description' => 'PUT /admin/realms/{realm}/users/{user-id}/groups/{groupId}.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_reset_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersUserIdResetPassword',
    'type' => 'write',
    'name' => 'Set up a new password for the user',
    'description' => 'Set up a new password for the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_reset_password_email' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersUserIdResetPasswordEmail',
    'type' => 'write',
    'name' => 'Send an email to the user with a link they can click to reset their password',
    'description' => 'The redirectUri and clientId parameters are optional. The default for the redirect is the account client. This endpoint has been deprecated. Please use the execute-actions-email passing a list with UPDATE_PASSWORD within it.',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_send_verify_email' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmUsersUserIdSendVerifyEmail',
    'type' => 'write',
    'name' => 'Send an email-verification email to the user An email contains a link the user can click to verify their email address',
    'description' => 'The redirectUri, clientId and lifespan parameters are optional. The default for the redirect is the account client. The default for the lifespan is 12 hours',
    'icon' => 'ph:pencil-simple',
  ),
  'keycloak_put_admin_realms_realm_workflows_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\Keycloak\\Tools\\KeycloakPutAdminRealmsRealmWorkflowsId',
    'type' => 'write',
    'name' => 'Update workflow',
    'description' => 'Update the workflow configuration. This method does not update the workflow steps.',
    'icon' => 'ph:pencil-simple',
  ),
); } public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/keycloak.md'; } public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Runtime context from the host. */ private function resolveService(array $context=[]): KeycloakService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new KeycloakService(accessToken:$creds->get('keycloak','access_token','',$account), baseUrl:$creds->get('keycloak','base_url','https://keycloak.example.test',$account));} return app(KeycloakService::class); }
}