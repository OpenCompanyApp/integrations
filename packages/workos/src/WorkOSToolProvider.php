<?php

namespace OpenCompany\Integrations\WorkOS;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for WorkOS.
 *
 * Exposes the official WorkOS OpenAPI operation set as endpoint-specific agent
 * tools and resolves account-specific API keys in multi-account hosts.
 */
class WorkOSToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'bearer_token','legacy_auth_type'=>'api_token','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Use a WorkOS sk_ API key as a bearer token.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'workos'; } public function appMeta(): array { return ['label'=>'WorkOS','description'=>'AuthKit, SSO, Directory Sync, Audit Logs, FGA, SCIM, organizations, and users','icon'=>'ph:shield-check','logo'=>'ph:shield-check']; }
    public function integrationMeta(): array { return ['name'=>'WorkOS','description'=>'Manage WorkOS AuthKit, SSO, Directory Sync, Audit Logs, Fine-Grained Authorization, SCIM, organizations, sessions, users, and webhooks.','icon'=>'ph:shield-check','logo'=>'ph:shield-check','category'=>'productivity','badge'=>'verified','docs_url'=>'https://workos.com/changelog/openapi-spec']; }
    public function configSchema(): array { return [['key'=>'api_key','type'=>'secret','label'=>'API Key','placeholder'=>'sk_example_...','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://api.workos.com','default'=>'https://api.workos.com']]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $key=(string)($config['api_key']??''); $baseUrl=rtrim((string)($config['url']??'https://api.workos.com'),'/'); if($key==='')return ['success'=>false,'error'=>'WorkOS API key is required.']; try{$response=Http::withHeaders(['Authorization'=>'Bearer '.$key,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/organizations'); if(!$response->successful())return ['success'=>false,'error'=>'WorkOS API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to WorkOS at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['api_key'=>'required|string','url'=>'nullable|url']; } public function credentialFields(): array { return [['key'=>'api_key','type'=>'secret','label'=>'API Key','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','required'=>false,'default'=>'https://api.workos.com']]; }
    public function tools(): array { return [
  'workos_api_keys_validate_api_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApiKeysValidateApiKey',
    'type' => 'write',
    'name' => 'Validate API key',
    'description' => 'Validate an API key value and return the API key object if valid.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_api_keys_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApiKeysDelete',
    'type' => 'write',
    'name' => 'Delete an API key',
    'description' => 'Permanently deletes an API key. This action cannot be undone. Once deleted, any requests using this API key will fail authentication.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_audit_log_validators_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuditLogValidatorsList',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Get a list of all Audit Log actions in the current environment.',
    'icon' => 'ph:shield-check',
  ),
  'workos_audit_log_validator_versions_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuditLogValidatorVersionsCreate',
    'type' => 'write',
    'name' => 'Create Schema',
    'description' => 'Creates a new Audit Log schema used to validate the payload of incoming Audit Log Events. If the `action` does not exist, it will also be created.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_audit_log_validator_versions_schemas' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuditLogValidatorVersionsSchemas',
    'type' => 'read',
    'name' => 'List Schemas',
    'description' => 'Get a list of all schemas for the Audit Logs action identified by `:name`.',
    'icon' => 'ph:shield-check',
  ),
  'workos_audit_log_events_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuditLogEventsCreate',
    'type' => 'write',
    'name' => 'Create Event',
    'description' => 'Create an Audit Log Event. This API supports idempotency which guarantees that performing the same operation multiple times will have the same result as if the operation were pe...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_audit_log_exports_exports' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuditLogExportsExports',
    'type' => 'write',
    'name' => 'Create Export',
    'description' => 'Create an Audit Log Export. Exports are scoped to a single organization within a specified date range.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_audit_log_exports_export' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuditLogExportsExport',
    'type' => 'read',
    'name' => 'Get Export',
    'description' => 'Get an Audit Log Export. The URL will expire after 10 minutes. If the export is needed again at a later time, refetching the export will regenerate the URL.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authentication_challenges_verify' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthenticationChallengesVerify',
    'type' => 'write',
    'name' => 'Verify Challenge',
    'description' => 'Verifies an Authentication Challenge.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authentication_factors_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthenticationFactorsCreate',
    'type' => 'write',
    'name' => 'Enroll Factor',
    'description' => 'Enrolls an Authentication Factor to be used as an additional factor of authentication. The returned ID should be used to create an authentication Challenge.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authentication_factors_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthenticationFactorsGet',
    'type' => 'read',
    'name' => 'Get Factor',
    'description' => 'Gets an Authentication Factor.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authentication_factors_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthenticationFactorsDelete',
    'type' => 'write',
    'name' => 'Delete Factor',
    'description' => 'Permanently deletes an Authentication Factor. It cannot be undone.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authentication_factors_challenge' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthenticationFactorsChallenge',
    'type' => 'write',
    'name' => 'Challenge Factor',
    'description' => 'Creates a Challenge for an Authentication Factor.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_external_auth_complete_login' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSExternalAuthCompleteLogin',
    'type' => 'write',
    'name' => 'Complete external authentication',
    'description' => 'Completes an external authentication flow and returns control to AuthKit. This endpoint is used with [Standalone Connect](/authkit/connect/standalone) to bridge your existing au...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_check' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationCheck',
    'type' => 'write',
    'name' => 'Check authorization',
    'description' => 'Check if an organization membership has a specific permission on a resource. Supports identification by resource_id OR by resource_external_id + resource_type_slug.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_list_resources_for_membership' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationListResourcesForMembership',
    'type' => 'read',
    'name' => 'List resources for organization membership',
    'description' => 'Returns all child resources of a parent resource where the organization membership has a specific permission. This is useful for resource discovery—answering "What projects ca...',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_list_effective_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationListEffectivePermissions',
    'type' => 'read',
    'name' => 'List effective permissions for an organization membership on a resource',
    'description' => 'Returns all permissions the organization membership effectively has on a resource, including permissions inherited through roles assigned to ancestor resources.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_list_effective_permissions_by_external_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationListEffectivePermissionsByExternalId',
    'type' => 'read',
    'name' => 'List effective permissions for an organization membership on a resource by external ID',
    'description' => 'Returns all permissions the organization membership effectively has on a resource identified by its external ID, including permissions inherited through roles assigned to ancest...',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_role_assignments_list_role_assignments' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRoleAssignmentsListRoleAssignments',
    'type' => 'write',
    'name' => 'List role assignments',
    'description' => 'List all role assignments for an organization membership. This returns all roles that have been assigned to the user on resources, including organization-level and sub-resource ...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_role_assignments_assign_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRoleAssignmentsAssignRole',
    'type' => 'write',
    'name' => 'Assign a role',
    'description' => 'Assign a role to an organization membership on a specific resource.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_role_assignments_remove_role_by_criteria' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRoleAssignmentsRemoveRoleByCriteria',
    'type' => 'write',
    'name' => 'Remove a role assignment',
    'description' => 'Remove a role assignment by role slug and resource.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_role_assignments_remove_role_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRoleAssignmentsRemoveRoleById',
    'type' => 'write',
    'name' => 'Remove a role assignment by ID',
    'description' => 'Remove a role assignment using its ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_organization_roles_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationOrganizationRolesCreate',
    'type' => 'write',
    'name' => 'Create a custom role',
    'description' => 'Create a new custom role for this organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_organization_roles_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationOrganizationRolesList',
    'type' => 'read',
    'name' => 'List custom roles',
    'description' => 'Get a list of all roles that apply to an organization. This includes both environment roles and custom roles, returned in priority order.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_organization_roles_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationOrganizationRolesGet',
    'type' => 'read',
    'name' => 'Get a custom role',
    'description' => 'Retrieve a role that applies to an organization by its slug. This can return either an environment role or a custom role.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_organization_roles_update' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationOrganizationRolesUpdate',
    'type' => 'write',
    'name' => 'Update a custom role',
    'description' => 'Update an existing custom role. Only the fields provided in the request body will be updated.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_organization_roles_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationOrganizationRolesDelete',
    'type' => 'write',
    'name' => 'Delete a custom role',
    'description' => 'Delete an existing custom role.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_organization_role_permissions_set_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationOrganizationRolePermissionsSetPermissions',
    'type' => 'write',
    'name' => 'Set permissions for a custom role',
    'description' => 'Replace all permissions on a custom role with the provided list.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_organization_role_permissions_add_permission' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationOrganizationRolePermissionsAddPermission',
    'type' => 'write',
    'name' => 'Add a permission to a custom role',
    'description' => 'Add a single permission to a custom role. If the permission is already assigned to the role, this operation has no effect.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_organization_role_permissions_remove_permission' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationOrganizationRolePermissionsRemovePermission',
    'type' => 'write',
    'name' => 'Remove a permission from a custom role',
    'description' => 'Remove a single permission from a custom role by its slug.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_resources_by_external_id_get_by_external_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesByExternalIdGetByExternalId',
    'type' => 'read',
    'name' => 'Get a resource by external ID',
    'description' => 'Retrieve the details of an authorization resource by its external ID, organization, and resource type. This is useful when you only have the external ID from your system and nee...',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_resources_by_external_id_update_by_external_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesByExternalIdUpdateByExternalId',
    'type' => 'write',
    'name' => 'Update a resource by external ID',
    'description' => 'Update an existing authorization resource using its external ID.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_resources_by_external_id_delete_by_external_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesByExternalIdDeleteByExternalId',
    'type' => 'write',
    'name' => 'Delete an authorization resource by external ID',
    'description' => 'Delete an authorization resource by organization, resource type, and external ID. This also deletes all descendant resources.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_resources_by_external_id_list_organization_memberships_for_resource_by_external_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesByExternalIdListOrganizationMembershipsForResourceByExternalId',
    'type' => 'read',
    'name' => 'List memberships for a resource by external ID',
    'description' => 'Returns all organization memberships that have a specific permission on a resource, using the resource\'s external ID. This is useful for answering "Who can access this resource?...',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_role_assignments_list_role_assignments_for_resource_by_external_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRoleAssignmentsListRoleAssignmentsForResourceByExternalId',
    'type' => 'write',
    'name' => 'List role assignments for a resource by external ID',
    'description' => 'List all role assignments granted on a resource, identified by its external ID. Each assignment includes the organization membership it was granted to.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_permissions_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationPermissionsList',
    'type' => 'read',
    'name' => 'List permissions',
    'description' => 'Get a list of all permissions in your WorkOS environment.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_permissions_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationPermissionsCreate',
    'type' => 'write',
    'name' => 'Create a permission',
    'description' => 'Create a new permission in your WorkOS environment. The permission can then be assigned to environment roles and custom roles.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_permissions_find' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationPermissionsFind',
    'type' => 'read',
    'name' => 'Get a permission',
    'description' => 'Retrieve a permission by its unique slug.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_permissions_update' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationPermissionsUpdate',
    'type' => 'write',
    'name' => 'Update a permission',
    'description' => 'Update an existing permission. Only the fields provided in the request body will be updated.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_permissions_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationPermissionsDelete',
    'type' => 'write',
    'name' => 'Delete a permission',
    'description' => 'Delete an existing permission. System permissions cannot be deleted.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_resources_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesList',
    'type' => 'read',
    'name' => 'List resources',
    'description' => 'Get a paginated list of authorization resources.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_resources_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesCreate',
    'type' => 'write',
    'name' => 'Create an authorization resource',
    'description' => 'Create a new authorization resource.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_resources_find_by_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesFindById',
    'type' => 'read',
    'name' => 'Get a resource',
    'description' => 'Retrieve the details of an authorization resource by its ID.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_resources_update' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesUpdate',
    'type' => 'write',
    'name' => 'Update a resource',
    'description' => 'Update an existing authorization resource.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_resources_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesDelete',
    'type' => 'write',
    'name' => 'Delete an authorization resource',
    'description' => 'Delete an authorization resource and all its descendants.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_resources_list_organization_memberships_for_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationResourcesListOrganizationMembershipsForResource',
    'type' => 'read',
    'name' => 'List organization memberships for resource',
    'description' => 'Returns all organization memberships that have a specific permission on a resource instance. This is useful for answering "Who can access this resource?".',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_role_assignments_list_role_assignments_for_resource' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRoleAssignmentsListRoleAssignmentsForResource',
    'type' => 'write',
    'name' => 'List role assignments for a resource',
    'description' => 'List all role assignments granted on a specific resource instance. Each assignment includes the organization membership it was granted to.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_roles_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRolesCreate',
    'type' => 'write',
    'name' => 'Create an environment role',
    'description' => 'Create a new environment role.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_roles_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRolesList',
    'type' => 'read',
    'name' => 'List environment roles',
    'description' => 'List all environment roles in priority order.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_roles_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRolesGet',
    'type' => 'read',
    'name' => 'Get an environment role',
    'description' => 'Get an environment role by its slug.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorization_roles_update' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRolesUpdate',
    'type' => 'write',
    'name' => 'Update an environment role',
    'description' => 'Update an existing environment role.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_role_permissions_set_permissions' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRolePermissionsSetPermissions',
    'type' => 'write',
    'name' => 'Set permissions for an environment role',
    'description' => 'Replace all permissions on an environment role with the provided list.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_authorization_role_permissions_add_permission' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizationRolePermissionsAddPermission',
    'type' => 'write',
    'name' => 'Add a permission to an environment role',
    'description' => 'Add a single permission to an environment role. If the permission is already assigned to the role, this operation has no effect.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_applications_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApplicationsList',
    'type' => 'read',
    'name' => 'List Connect Applications',
    'description' => 'List all Connect Applications in the current environment with optional filtering.',
    'icon' => 'ph:shield-check',
  ),
  'workos_applications_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApplicationsCreate',
    'type' => 'write',
    'name' => 'Create a Connect Application',
    'description' => 'Create a new Connect Application. Supports both OAuth and Machine-to-Machine (M2M) application types.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_applications_find' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApplicationsFind',
    'type' => 'read',
    'name' => 'Get a Connect Application',
    'description' => 'Retrieve details for a specific Connect Application by ID or client ID.',
    'icon' => 'ph:shield-check',
  ),
  'workos_applications_update' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApplicationsUpdate',
    'type' => 'write',
    'name' => 'Update a Connect Application',
    'description' => 'Update an existing Connect Application. For OAuth applications, you can update redirect URIs. For all applications, you can update the name, description, and scopes.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_applications_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApplicationsDelete',
    'type' => 'write',
    'name' => 'Delete a Connect Application',
    'description' => 'Delete an existing Connect Application.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_application_credentials_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApplicationCredentialsList',
    'type' => 'read',
    'name' => 'List Client Secrets for a Connect Application',
    'description' => 'List all client secrets associated with a Connect Application.',
    'icon' => 'ph:shield-check',
  ),
  'workos_application_credentials_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApplicationCredentialsCreate',
    'type' => 'write',
    'name' => 'Create a new client secret for a Connect Application',
    'description' => 'Create new secrets for a Connect Application.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_application_credentials_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSApplicationCredentialsDelete',
    'type' => 'write',
    'name' => 'Delete a Client Secret',
    'description' => 'Delete (revoke) an existing client secret.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_connections_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSConnectionsList',
    'type' => 'read',
    'name' => 'List Connections',
    'description' => 'Get a list of all of your existing connections matching the criteria specified.',
    'icon' => 'ph:shield-check',
  ),
  'workos_connections_find' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSConnectionsFind',
    'type' => 'read',
    'name' => 'Get a Connection',
    'description' => 'Get the details of an existing connection.',
    'icon' => 'ph:shield-check',
  ),
  'workos_connections_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSConnectionsDelete',
    'type' => 'write',
    'name' => 'Delete a Connection',
    'description' => 'Permanently deletes an existing connection. It cannot be undone.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_data_integrations_get_data_integration_authorize_url' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDataIntegrationsGetDataIntegrationAuthorizeUrl',
    'type' => 'write',
    'name' => 'Get authorization URL',
    'description' => 'Generates an OAuth authorization URL to initiate the connection flow for a user. Redirect the user to the returned URL to begin the OAuth flow with the third-party provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_data_integrations_get_userland_user_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDataIntegrationsGetUserlandUserToken',
    'type' => 'write',
    'name' => 'Get an access token for a connected account',
    'description' => 'Fetches a valid OAuth access token for a user\'s connected account. WorkOS automatically handles token refresh, ensuring you always receive a valid, non-expired token.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_directories_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDirectoriesList',
    'type' => 'read',
    'name' => 'List Directories',
    'description' => 'Get a list of all of your existing directories matching the criteria specified.',
    'icon' => 'ph:shield-check',
  ),
  'workos_directories_find' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDirectoriesFind',
    'type' => 'read',
    'name' => 'Get a Directory',
    'description' => 'Get the details of an existing directory.',
    'icon' => 'ph:shield-check',
  ),
  'workos_directories_delete_directory' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDirectoriesDeleteDirectory',
    'type' => 'write',
    'name' => 'Delete a Directory',
    'description' => 'Permanently deletes an existing directory. It cannot be undone.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_directory_groups_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDirectoryGroupsList',
    'type' => 'read',
    'name' => 'List Directory Groups',
    'description' => 'Get a list of all of existing directory groups matching the criteria specified.',
    'icon' => 'ph:shield-check',
  ),
  'workos_directory_groups_find' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDirectoryGroupsFind',
    'type' => 'read',
    'name' => 'Get a Directory Group',
    'description' => 'Get the details of an existing Directory Group.',
    'icon' => 'ph:shield-check',
  ),
  'workos_directory_users_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDirectoryUsersList',
    'type' => 'read',
    'name' => 'List Directory Users',
    'description' => 'Get a list of all of existing Directory Users matching the criteria specified.',
    'icon' => 'ph:shield-check',
  ),
  'workos_directory_users_find' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDirectoryUsersFind',
    'type' => 'read',
    'name' => 'Get a Directory User',
    'description' => 'Get the details of an existing Directory User.',
    'icon' => 'ph:shield-check',
  ),
  'workos_events_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSEventsList',
    'type' => 'read',
    'name' => 'List events',
    'description' => 'List events for the current environment.',
    'icon' => 'ph:shield-check',
  ),
  'workos_feature_flags_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSFeatureFlagsList',
    'type' => 'read',
    'name' => 'List feature flags',
    'description' => 'Get a list of all of your existing feature flags matching the criteria specified.',
    'icon' => 'ph:shield-check',
  ),
  'workos_feature_flags_find_by_slug' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSFeatureFlagsFindBySlug',
    'type' => 'read',
    'name' => 'Get a feature flag',
    'description' => 'Get the details of an existing feature flag by its slug.',
    'icon' => 'ph:shield-check',
  ),
  'workos_feature_flags_disable_flag' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSFeatureFlagsDisableFlag',
    'type' => 'write',
    'name' => 'Disable a feature flag',
    'description' => 'Disables a feature flag in the current environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_feature_flags_enable_flag' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSFeatureFlagsEnableFlag',
    'type' => 'write',
    'name' => 'Enable a feature flag',
    'description' => 'Enables a feature flag in the current environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_flag_targets_create_target' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSFlagTargetsCreateTarget',
    'type' => 'write',
    'name' => 'Add a feature flag target',
    'description' => 'Enables a feature flag for a specific target in the current environment. Currently, supported targets include users and organizations.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_flag_targets_delete_target' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSFlagTargetsDeleteTarget',
    'type' => 'write',
    'name' => 'Remove a feature flag target',
    'description' => 'Removes a target from the feature flag\'s target list in the current environment. Currently, supported targets include users and organizations.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organization_domains_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationDomainsCreate',
    'type' => 'write',
    'name' => 'Create an Organization Domain',
    'description' => 'Creates a new Organization Domain.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organization_domains_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationDomainsGet',
    'type' => 'read',
    'name' => 'Get an Organization Domain',
    'description' => 'Get the details of an existing organization domain.',
    'icon' => 'ph:shield-check',
  ),
  'workos_organization_domains_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationDomainsDelete',
    'type' => 'write',
    'name' => 'Delete an Organization Domain',
    'description' => 'Permanently deletes an organization domain. It cannot be undone.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organization_domains_verify' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationDomainsVerify',
    'type' => 'write',
    'name' => 'Verify an Organization Domain',
    'description' => 'Initiates verification process for an Organization Domain.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organizations_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationsList',
    'type' => 'read',
    'name' => 'List Organizations',
    'description' => 'Get a list of all of your existing organizations matching the criteria specified.',
    'icon' => 'ph:shield-check',
  ),
  'workos_organizations_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationsCreate',
    'type' => 'write',
    'name' => 'Create an Organization',
    'description' => 'Creates a new organization in the current environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organizations_get_by_external_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationsGetByExternalId',
    'type' => 'read',
    'name' => 'Get an Organization by External ID',
    'description' => 'Get the details of an existing organization by an [external identifier](/authkit/metadata/external-identifiers).',
    'icon' => 'ph:shield-check',
  ),
  'workos_organizations_find' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationsFind',
    'type' => 'read',
    'name' => 'Get an Organization',
    'description' => 'Get the details of an existing organization.',
    'icon' => 'ph:shield-check',
  ),
  'workos_organizations_update_organization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationsUpdateOrganization',
    'type' => 'write',
    'name' => 'Update an Organization',
    'description' => 'Updates an organization in the current environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organizations_delete_organization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationsDeleteOrganization',
    'type' => 'write',
    'name' => 'Delete an Organization',
    'description' => 'Permanently deletes an organization in the current environment. It cannot be undone.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organizations_get_audit_log_configuration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationsGetAuditLogConfiguration',
    'type' => 'read',
    'name' => 'Get Audit Log Configuration',
    'description' => 'Get the unified view of audit log trail and stream configuration for an organization.',
    'icon' => 'ph:shield-check',
  ),
  'workos_audit_logs_retention_audit_logs_retention' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuditLogsRetentionAuditLogsRetention',
    'type' => 'read',
    'name' => 'Get Retention',
    'description' => 'Get the configured event retention period for the given Organization.',
    'icon' => 'ph:shield-check',
  ),
  'workos_audit_logs_retention_update_audit_logs_retention' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuditLogsRetentionUpdateAuditLogsRetention',
    'type' => 'write',
    'name' => 'Set Retention',
    'description' => 'Set the event retention period for the given Organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organization_api_keys_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationApiKeysList',
    'type' => 'read',
    'name' => 'List API keys for an organization',
    'description' => 'Get a list of all API keys for an organization.',
    'icon' => 'ph:shield-check',
  ),
  'workos_organization_api_keys_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationApiKeysCreate',
    'type' => 'write',
    'name' => 'Create an API key for an organization',
    'description' => 'Create a new API key for an organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organization_feature_flags_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationFeatureFlagsList',
    'type' => 'read',
    'name' => 'List enabled feature flags for an organization',
    'description' => 'Get a list of all enabled feature flags for an organization.',
    'icon' => 'ph:shield-check',
  ),
  'workos_groups_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSGroupsCreate',
    'type' => 'write',
    'name' => 'Create a group',
    'description' => 'Create a new group within an organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_groups_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSGroupsList',
    'type' => 'read',
    'name' => 'List groups',
    'description' => 'Get a paginated list of groups within an organization.',
    'icon' => 'ph:shield-check',
  ),
  'workos_groups_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSGroupsGet',
    'type' => 'read',
    'name' => 'Get a group',
    'description' => 'Retrieve a group by its ID within an organization.',
    'icon' => 'ph:shield-check',
  ),
  'workos_groups_update' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSGroupsUpdate',
    'type' => 'write',
    'name' => 'Update a group',
    'description' => 'Update an existing group. Only the fields provided in the request body will be updated.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_groups_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSGroupsDelete',
    'type' => 'write',
    'name' => 'Delete a group',
    'description' => 'Delete a group from an organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_group_memberships_add_member' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSGroupMembershipsAddMember',
    'type' => 'write',
    'name' => 'Add a member to a Group',
    'description' => 'Add an organization membership to a group.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_group_memberships_list_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSGroupMembershipsListMembers',
    'type' => 'read',
    'name' => 'List Group members',
    'description' => 'Get a list of organization memberships in a group.',
    'icon' => 'ph:shield-check',
  ),
  'workos_group_memberships_remove_member' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSGroupMembershipsRemoveMember',
    'type' => 'write',
    'name' => 'Remove a member from a Group',
    'description' => 'Remove an organization membership from a group.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_portal_sessions_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSPortalSessionsCreate',
    'type' => 'write',
    'name' => 'Generate a Portal Link',
    'description' => 'Generate a Portal Link scoped to an Organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_radar_standalone_assess' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSRadarStandaloneAssess',
    'type' => 'write',
    'name' => 'Create an attempt',
    'description' => 'Assess a request for risk using the Radar engine and receive a verdict.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_radar_standalone_update_radar_attempt' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSRadarStandaloneUpdateRadarAttempt',
    'type' => 'write',
    'name' => 'Update a Radar attempt',
    'description' => 'You may optionally inform Radar that an authentication attempt or challenge was successful using this endpoint. Some Radar controls depend on tracking recent successful attempts...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_radar_standalone_update_radar_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSRadarStandaloneUpdateRadarList',
    'type' => 'write',
    'name' => 'Add an entry to a Radar list',
    'description' => 'Add an entry to a Radar list.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_radar_standalone_delete_radar_list_entry' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSRadarStandaloneDeleteRadarListEntry',
    'type' => 'write',
    'name' => 'Remove an entry from a Radar list',
    'description' => 'Remove an entry from a Radar list.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_sso_authorize' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSSsoAuthorize',
    'type' => 'read',
    'name' => 'Initiate SSO',
    'description' => 'Initiates the single sign-on flow.',
    'icon' => 'ph:shield-check',
  ),
  'workos_sso_json_web_key_set' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSSsoJsonWebKeySet',
    'type' => 'read',
    'name' => 'Get JWKS',
    'description' => 'Returns the JSON Web Key Set (JWKS) containing the public keys used for verifying access tokens.',
    'icon' => 'ph:shield-check',
  ),
  'workos_sso_logout' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSSsoLogout',
    'type' => 'read',
    'name' => 'Logout Redirect',
    'description' => 'Logout allows to sign out a user from your application by triggering the identity provider sign out flow. This `GET` endpoint should be a redirection, since the identity provide...',
    'icon' => 'ph:shield-check',
  ),
  'workos_sso_logout_authorize' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSSsoLogoutAuthorize',
    'type' => 'write',
    'name' => 'Logout Authorize',
    'description' => 'You should call this endpoint from your server to generate a logout token which is required for the [Logout Redirect](/reference/sso/logout) endpoint.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_sso_get_profile' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSSsoGetProfile',
    'type' => 'read',
    'name' => 'Get a User Profile',
    'description' => 'Exchange an access token for a user\'s [Profile](/reference/sso/profile). Because this profile is returned in the [Get a Profile and Token endpoint](/reference/sso/profile/get-pr...',
    'icon' => 'ph:shield-check',
  ),
  'workos_sso_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSSsoToken',
    'type' => 'write',
    'name' => 'Get a Profile and Token',
    'description' => 'Get an access token along with the user [Profile](/reference/sso/profile) using the code passed to your [Redirect URI](/reference/sso/get-authorization-url/redirect-uri).',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_sessions_authenticate_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandSessionsAuthenticate0',
    'type' => 'write',
    'name' => 'Authenticate',
    'description' => 'Authenticate a user with a specified [authentication method](/reference/authkit/authentication).',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_sso_authorize' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandSsoAuthorize',
    'type' => 'read',
    'name' => 'Get an authorization URL',
    'description' => 'Generates an OAuth 2.0 authorization URL to authenticate a user with AuthKit or SSO.',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_sso_device_authorization' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandSsoDeviceAuthorization',
    'type' => 'write',
    'name' => 'Get device authorization URL',
    'description' => 'Initiates the CLI Auth flow by requesting a device code and verification URLs. This endpoint implements the OAuth 2.0 Device Authorization Flow ([RFC 8628](https://datatracker.i...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_cors_origins_create_cors_origin' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSCorsOriginsCreateCorsOrigin',
    'type' => 'write',
    'name' => 'Create a CORS origin',
    'description' => 'Creates a new CORS origin for the current environment. CORS origins allow browser-based applications to make requests to the WorkOS API.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_get_email_verification' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersGetEmailVerification',
    'type' => 'read',
    'name' => 'Get an email verification code',
    'description' => 'Get the details of an existing email verification code that can be used to send an email to a user for verification.',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_user_invites_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserInvitesList',
    'type' => 'write',
    'name' => 'List invitations',
    'description' => 'Get a list of all of invitations matching the criteria specified.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_invites_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserInvitesCreate',
    'type' => 'write',
    'name' => 'Send an invitation',
    'description' => 'Sends an invitation email to the recipient.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_invites_get_by_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserInvitesGetByToken',
    'type' => 'write',
    'name' => 'Find an invitation by token',
    'description' => 'Retrieve an existing invitation using the token.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_invites_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserInvitesGet',
    'type' => 'write',
    'name' => 'Get an invitation',
    'description' => 'Get the details of an existing invitation.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_invites_accept' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserInvitesAccept',
    'type' => 'write',
    'name' => 'Accept an invitation',
    'description' => 'Accepts an invitation and, if linked to an organization, activates the user\'s membership in that organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_invites_resend' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserInvitesResend',
    'type' => 'write',
    'name' => 'Resend an invitation',
    'description' => 'Resends an invitation email to the recipient. The invitation must be in a pending state.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_invites_revoke' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserInvitesRevoke',
    'type' => 'write',
    'name' => 'Revoke an invitation',
    'description' => 'Revokes an existing invitation.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_jwt_templates_get_jwt_template' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSJwtTemplatesGetJwtTemplate',
    'type' => 'read',
    'name' => 'Get JWT template',
    'description' => 'Get the JWT template for the current environment.',
    'icon' => 'ph:shield-check',
  ),
  'workos_jwt_templates_update_jwt_template' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSJwtTemplatesUpdateJwtTemplate',
    'type' => 'write',
    'name' => 'Update JWT template',
    'description' => 'Update the JWT template for the current environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_magic_auth_send_magic_auth_code_and_return' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandMagicAuthSendMagicAuthCodeAndReturn',
    'type' => 'write',
    'name' => 'Create a Magic Auth code',
    'description' => 'Creates a one-time authentication code that can be sent to the user\'s email address. The code expires in 10 minutes. To verify the code, [authenticate the user with Magic Auth](...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_magic_auth_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandMagicAuthGet',
    'type' => 'read',
    'name' => 'Get Magic Auth code details',
    'description' => 'Get the details of an existing [Magic Auth](/reference/authkit/magic-auth) code that can be used to send an email to a user for authentication.',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_user_organization_memberships_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserOrganizationMembershipsList',
    'type' => 'read',
    'name' => 'List organization memberships',
    'description' => 'Get a list of all organization memberships matching the criteria specified. At least one of `user_id` or `organization_id` must be provided. By default only active memberships a...',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_user_organization_memberships_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserOrganizationMembershipsCreate',
    'type' => 'write',
    'name' => 'Create an organization membership',
    'description' => 'Creates a new `active` organization membership for the given organization and user. Calling this API with an organization and user that match an `inactive` organization membersh...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_organization_memberships_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserOrganizationMembershipsGet',
    'type' => 'read',
    'name' => 'Get an organization membership',
    'description' => 'Get the details of an existing organization membership.',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_user_organization_memberships_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserOrganizationMembershipsDelete',
    'type' => 'write',
    'name' => 'Delete an organization membership',
    'description' => 'Permanently deletes an existing organization membership. It cannot be undone.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_organization_memberships_update' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserOrganizationMembershipsUpdate',
    'type' => 'write',
    'name' => 'Update an organization membership',
    'description' => 'Update the details of an existing organization membership.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_organization_memberships_deactivate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserOrganizationMembershipsDeactivate',
    'type' => 'write',
    'name' => 'Deactivate an organization membership',
    'description' => 'Deactivates an `active` organization membership. Emits an [organization_membership.updated](/events/organization-membership) event upon successful deactivation. - Deactivating a...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_organization_memberships_reactivate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserOrganizationMembershipsReactivate',
    'type' => 'write',
    'name' => 'Reactivate an organization membership',
    'description' => 'Reactivates an `inactive` organization membership, retaining the pre-existing role(s). Emits an [organization_membership.updated](/events/organization-membership) event upon suc...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_organization_membership_groups_list_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSOrganizationMembershipGroupsListGroups',
    'type' => 'read',
    'name' => 'List groups',
    'description' => 'Get a list of groups that an organization membership belongs to.',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_users_create_password_reset_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersCreatePasswordResetToken',
    'type' => 'write',
    'name' => 'Create a password reset token',
    'description' => 'Creates a one-time token that can be used to reset a user\'s password.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_reset_password_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersResetPassword0',
    'type' => 'write',
    'name' => 'Reset the password',
    'description' => 'Sets a new password using the `token` query parameter from the link that the user received. Successfully resetting the password will verify a user\'s email, if it hasn\'t been ver...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_get_password_reset' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersGetPasswordReset',
    'type' => 'write',
    'name' => 'Get a password reset token',
    'description' => 'Get the details of an existing password reset token that can be used to reset a user\'s password.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_redirect_uris_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSRedirectUrisCreate',
    'type' => 'write',
    'name' => 'Create a redirect URI',
    'description' => 'Creates a new redirect URI for an environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_sessions_logout' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandSessionsLogout',
    'type' => 'read',
    'name' => 'Logout',
    'description' => 'Logout a user from the current [session](/reference/authkit/session).',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_sessions_revoke_session' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandSessionsRevokeSession',
    'type' => 'write',
    'name' => 'Revoke Session',
    'description' => 'Revoke a [user session](/reference/authkit/session).',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_list_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersList0',
    'type' => 'read',
    'name' => 'List users',
    'description' => 'Get a list of all of your existing users matching the criteria specified.',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_users_create_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersCreate0',
    'type' => 'write',
    'name' => 'Create a user',
    'description' => 'Create a new user in the current environment.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_get_by_external_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersGetByExternalId',
    'type' => 'read',
    'name' => 'Get a user by external ID',
    'description' => 'Get the details of an existing user by an [external identifier](/authkit/metadata/external-identifiers).',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_users_update_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersUpdate0',
    'type' => 'write',
    'name' => 'Update a user',
    'description' => 'Updates properties of a user. The omitted properties will be left unchanged.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_get_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersGet0',
    'type' => 'read',
    'name' => 'Get a user',
    'description' => 'Get the details of an existing user.',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_users_delete_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersDelete0',
    'type' => 'write',
    'name' => 'Delete a user',
    'description' => 'Permanently deletes a user in the current environment. It cannot be undone.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_confirm_email_change' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersConfirmEmailChange',
    'type' => 'write',
    'name' => 'Confirm email change',
    'description' => 'Confirms an email change using the one-time code received by the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_send_email_change' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersSendEmailChange',
    'type' => 'write',
    'name' => 'Send email change code',
    'description' => 'Sends an email that contains a one-time code used to change a user\'s email address.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_email_verification_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersEmailVerification0',
    'type' => 'write',
    'name' => 'Verify email',
    'description' => 'Verifies an email address using the one-time code received by the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_users_send_verification_email_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUsersSendVerificationEmail0',
    'type' => 'write',
    'name' => 'Send verification email',
    'description' => 'Sends an email that contains a one-time code used to verify a user’s email address.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_identities_get' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserIdentitiesGet',
    'type' => 'read',
    'name' => 'Get user identities',
    'description' => 'Get a list of identities associated with the user. A user can have multiple associated identities after going through [identity linking](/authkit/identity-linking). Currently on...',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_user_sessions_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserSessionsList',
    'type' => 'read',
    'name' => 'List sessions',
    'description' => 'Get a list of all active sessions for a specific user.',
    'icon' => 'ph:shield-check',
  ),
  'workos_user_api_keys_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserApiKeysList',
    'type' => 'read',
    'name' => 'List API keys for a user',
    'description' => 'Get a list of API keys owned by a specific user.',
    'icon' => 'ph:shield-check',
  ),
  'workos_user_api_keys_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserApiKeysCreate',
    'type' => 'write',
    'name' => 'Create an API key for a user',
    'description' => 'Create a new API key owned by a user. The user must have an active membership in the specified organization.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_feature_flags_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserFeatureFlagsList',
    'type' => 'read',
    'name' => 'List enabled feature flags for a user',
    'description' => 'Get a list of all enabled feature flags for the provided user. This includes feature flags enabled specifically for the user as well as any organizations that the user is a memb...',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorized_applications_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizedApplicationsList',
    'type' => 'read',
    'name' => 'List authorized applications',
    'description' => 'Get a list of all Connect applications that the user has authorized.',
    'icon' => 'ph:shield-check',
  ),
  'workos_authorized_applications_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSAuthorizedApplicationsDelete',
    'type' => 'write',
    'name' => 'Delete an authorized application',
    'description' => 'Delete an existing Authorized Connect Application.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_data_integrations_user_management_get_user_data_installation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDataIntegrationsUserManagementGetUserDataInstallation',
    'type' => 'read',
    'name' => 'Get a connected account',
    'description' => 'Retrieves a user\'s [connected account](/reference/pipes/connected-account) for a specific provider.',
    'icon' => 'ph:shield-check',
  ),
  'workos_data_integrations_user_management_delete_user_data_installation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDataIntegrationsUserManagementDeleteUserDataInstallation',
    'type' => 'write',
    'name' => 'Delete a connected account',
    'description' => 'Disconnects WorkOS\'s account for the user, including removing any stored access and refresh tokens. The user will need to reauthorize if they want to reconnect. This does not re...',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_data_integrations_user_management_get_user_data_integrations' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSDataIntegrationsUserManagementGetUserDataIntegrations',
    'type' => 'read',
    'name' => 'List providers',
    'description' => 'Retrieves a list of available providers and the user\'s connection status for each. Returns all providers configured for your environment, along with the user\'s [connected accoun...',
    'icon' => 'ph:shield-check',
  ),
  'workos_userland_user_authentication_factors_create_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserAuthenticationFactorsCreate0',
    'type' => 'write',
    'name' => 'Enroll an authentication factor',
    'description' => 'Enrolls a user in a new [authentication factor](/reference/authkit/mfa/authentication-factor).',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_userland_user_authentication_factors_list_0' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSUserlandUserAuthenticationFactorsList0',
    'type' => 'read',
    'name' => 'List authentication factors',
    'description' => 'Lists the [authentication factors](/reference/authkit/mfa/authentication-factor) for a user.',
    'icon' => 'ph:shield-check',
  ),
  'workos_webhook_endpoints_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSWebhookEndpointsList',
    'type' => 'read',
    'name' => 'List Webhook Endpoints',
    'description' => 'Get a list of all of your existing webhook endpoints.',
    'icon' => 'ph:shield-check',
  ),
  'workos_webhook_endpoints_create' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSWebhookEndpointsCreate',
    'type' => 'write',
    'name' => 'Create a Webhook Endpoint',
    'description' => 'Create a new webhook endpoint to receive event notifications.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_webhook_endpoints_update' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSWebhookEndpointsUpdate',
    'type' => 'write',
    'name' => 'Update a Webhook Endpoint',
    'description' => 'Update the properties of an existing webhook endpoint.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_webhook_endpoints_delete' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSWebhookEndpointsDelete',
    'type' => 'write',
    'name' => 'Delete a Webhook Endpoint',
    'description' => 'Delete an existing webhook endpoint.',
    'icon' => 'ph:pencil-simple',
  ),
  'workos_widgets_public_issue_widget_session_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\WorkOS\\Tools\\WorkOSWidgetsPublicIssueWidgetSessionToken',
    'type' => 'write',
    'name' => 'Generate a widget token',
    'description' => 'Generate a widget token scoped to an organization and user with the specified scopes.',
    'icon' => 'ph:pencil-simple',
  ),
]; }
    public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); } public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/workos.md'; }
    /** @param  array<string, mixed>  $context  Optional account context from the host. */ private function resolveService(array $context = []): WorkOSService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new WorkOSService(apiKey:$creds->get('workos','api_key','',$account), baseUrl:$creds->get('workos','url','https://api.workos.com',$account));} return app(WorkOSService::class); }
}