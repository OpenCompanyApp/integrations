<?php

namespace OpenCompany\Integrations\Keycloak;

/**
 * Official Keycloak Admin REST API operation metadata.
 *
 * Generated from the Keycloak OpenAPI document published by the Keycloak project.
 */
class KeycloakOperations
{
    /** @return array<string, array<string, mixed>> */
    public static function all(): array
    {
        return array (
  'keycloak_delete_admin_realms_realm' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm',
    'class' => 'KeycloakDeleteAdminRealmsRealm',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}',
    'summary' => 'Delete the realm',
    'description' => 'Delete the realm.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_admin_events' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_admin_events',
    'class' => 'KeycloakDeleteAdminRealmsRealmAdminEvents',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/admin-events',
    'summary' => 'Delete all admin events',
    'description' => 'Delete all admin events.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_attack_detection_brute_force_users' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_attack_detection_brute_force_users',
    'class' => 'KeycloakDeleteAdminRealmsRealmAttackDetectionBruteForceUsers',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/attack-detection/brute-force/users',
    'summary' => 'Clear any user login failures for all users This can release temporary disabled users',
    'description' => 'Clear any user login failures for all users This can release temporary disabled users.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_attack_detection_brute_force_users_user_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_attack_detection_brute_force_users_user_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmAttackDetectionBruteForceUsersUserId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/attack-detection/brute-force/users/{userId}',
    'summary' => 'Clear any user login failures for the user This can release temporary disabled user',
    'description' => 'Clear any user login failures for the user This can release temporary disabled user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `userId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_authentication_config_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_authentication_config_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmAuthenticationConfigId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/authentication/config/{id}',
    'summary' => 'Delete authenticator configuration',
    'description' => 'Delete authenticator configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Configuration id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_authentication_executions_execution_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_authentication_executions_execution_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmAuthenticationExecutionsExecutionId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/authentication/executions/{executionId}',
    'summary' => 'Delete execution',
    'description' => 'Delete execution.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'execution_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Execution id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'executionId' => 'execution_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_authentication_flows_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_authentication_flows_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmAuthenticationFlowsId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/authentication/flows/{id}',
    'summary' => 'Delete an authentication flow',
    'description' => 'Delete an authentication flow.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Flow id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_authentication_required_actions_alias' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_authentication_required_actions_alias',
    'class' => 'KeycloakDeleteAdminRealmsRealmAuthenticationRequiredActionsAlias',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}',
    'summary' => 'Delete required action',
    'description' => 'Delete required action.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of required action',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_authentication_required_actions_alias_config' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_authentication_required_actions_alias_config',
    'class' => 'KeycloakDeleteAdminRealmsRealmAuthenticationRequiredActionsAliasConfig',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/config',
    'summary' => 'Delete RequiredAction configuration',
    'description' => 'Delete RequiredAction configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of required action',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientScopesClientScopeId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}',
    'summary' => 'Delete the client scope',
    'description' => 'Delete the client scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModelsId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/models/{id}',
    'summary' => 'Delete the mapper',
    'description' => 'Delete the mapper.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClient',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/clients/{client}',
    'summary' => 'Remove client-level roles from the client\'s scope',
    'description' => 'Remove client-level roles from the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealm',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/realm',
    'summary' => 'Remove a set of realm-level roles from the client\'s scope',
    'description' => 'Remove a set of realm-level roles from the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_client_templates_client_scope_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_client_templates_client_scope_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}',
    'summary' => 'Delete the client scope',
    'description' => 'Delete the client scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModelsId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/protocol-mappers/models/{id}',
    'summary' => 'Delete the mapper',
    'description' => 'Delete the mapper.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClient',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/clients/{client}',
    'summary' => 'Remove client-level roles from the client\'s scope',
    'description' => 'Remove client-level roles from the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealm',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/realm',
    'summary' => 'Remove a set of realm-level roles from the client\'s scope',
    'description' => 'Remove a set of realm-level roles from the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuid',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}',
    'summary' => 'Delete the client',
    'description' => 'Delete the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
    'summary' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
    'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `_id`.',
      ),
      'deep' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `deep`.',
      ),
      'exact_name' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exactName`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'matching_uri' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `matchingUri`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
      'uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `uri`.',
      ),
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `resource-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'resource-id' => 'resource_id',
    ),
    'query_params' =>
    array (
      '_id' => 'id',
      'deep' => 'deep',
      'exactName' => 'exact_name',
      'first' => 'first',
      'matchingUri' => 'matching_uri',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'scope' => 'scope',
      'type' => 'type',
      'uri' => 'uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
    'summary' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
    'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'scope-id' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_client_secret_rotated' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_client_secret_rotated',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidClientSecretRotated',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/client-secret/rotated',
    'summary' => 'Invalidate the rotated secret for the client',
    'description' => 'Invalidate the rotated secret for the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_default_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_default_client_scopes_client_scope_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidDefaultClientScopesClientScopeId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}',
    'summary' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}',
    'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientScopeId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'clientScopeId' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_nodes_node' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_nodes_node',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidNodesNode',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/nodes/{node}',
    'summary' => 'Unregister a cluster node from the client',
    'description' => 'Unregister a cluster node from the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'node' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `node`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'node' => 'node',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_optional_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_optional_client_scopes_client_scope_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidOptionalClientScopesClientScopeId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}',
    'summary' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}',
    'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientScopeId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'clientScopeId' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidProtocolMappersModelsId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/models/{id}',
    'summary' => 'Delete the mapper',
    'description' => 'Delete the mapper.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_roles_role_name' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_roles_role_name',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidRolesRoleName',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}',
    'summary' => 'Delete a role by name',
    'description' => 'Delete a role by name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_roles_role_name_composites' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_roles_role_name_composites',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidRolesRoleNameComposites',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites',
    'summary' => 'Remove roles from the role\'s composite',
    'description' => 'Remove roles from the role\'s composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidScopeMappingsClientsClient',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}',
    'summary' => 'Remove client-level roles from the client\'s scope',
    'description' => 'Remove client-level roles from the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_client_uuid_scope_mappings_realm' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_scope_mappings_realm',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidScopeMappingsRealm',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm',
    'summary' => 'Remove a set of realm-level roles from the client\'s scope',
    'description' => 'Remove a set of realm-level roles from the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_clients_initial_access_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_clients_initial_access_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmClientsInitialAccessId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/clients-initial-access/{id}',
    'summary' => 'DELETE /admin/realms/{realm}/clients-initial-access/{id}',
    'description' => 'DELETE /admin/realms/{realm}/clients-initial-access/{id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_components_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_components_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmComponentsId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/components/{id}',
    'summary' => 'DELETE /admin/realms/{realm}/components/{id}',
    'description' => 'DELETE /admin/realms/{realm}/components/{id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_default_default_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_default_default_client_scopes_client_scope_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmDefaultDefaultClientScopesClientScopeId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
    'summary' => 'DELETE /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
    'description' => 'DELETE /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientScopeId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'clientScopeId' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_default_groups_group_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_default_groups_group_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmDefaultGroupsGroupId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/default-groups/{groupId}',
    'summary' => 'DELETE /admin/realms/{realm}/default-groups/{groupId}',
    'description' => 'DELETE /admin/realms/{realm}/default-groups/{groupId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `groupId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'groupId' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_default_optional_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_default_optional_client_scopes_client_scope_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmDefaultOptionalClientScopesClientScopeId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}',
    'summary' => 'DELETE /admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}',
    'description' => 'DELETE /admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientScopeId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'clientScopeId' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_events' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_events',
    'class' => 'KeycloakDeleteAdminRealmsRealmEvents',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/events',
    'summary' => 'Delete all events',
    'description' => 'Delete all events.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_groups_group_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_groups_group_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmGroupsGroupId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/groups/{group-id}',
    'summary' => 'DELETE /admin/realms/{realm}/groups/{group-id}',
    'description' => 'DELETE /admin/realms/{realm}/groups/{group-id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_groups_group_id_role_mappings_clients_client_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_groups_group_id_role_mappings_clients_client_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id}',
    'summary' => 'Delete client-level roles from user or group role mapping',
    'description' => 'Delete client-level roles from user or group role mapping.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_groups_group_id_role_mappings_realm' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_groups_group_id_role_mappings_realm',
    'class' => 'KeycloakDeleteAdminRealmsRealmGroupsGroupIdRoleMappingsRealm',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/realm',
    'summary' => 'Delete realm-level role mappings',
    'description' => 'Delete realm-level role mappings.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_identity_provider_instances_alias' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_identity_provider_instances_alias',
    'class' => 'KeycloakDeleteAdminRealmsRealmIdentityProviderInstancesAlias',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}',
    'summary' => 'Delete the identity provider',
    'description' => 'Delete the identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_identity_provider_instances_alias_mappers_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_identity_provider_instances_alias_mappers_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmIdentityProviderInstancesAliasMappersId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers/{id}',
    'summary' => 'Delete a mapper for the identity provider',
    'description' => 'Delete a mapper for the identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_localization_locale' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_localization_locale',
    'class' => 'KeycloakDeleteAdminRealmsRealmLocalizationLocale',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/localization/{locale}',
    'summary' => 'DELETE /admin/realms/{realm}/localization/{locale}',
    'description' => 'DELETE /admin/realms/{realm}/localization/{locale}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'locale' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `locale`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'locale' => 'locale',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_localization_locale_key' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_localization_locale_key',
    'class' => 'KeycloakDeleteAdminRealmsRealmLocalizationLocaleKey',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/localization/{locale}/{key}',
    'summary' => 'DELETE /admin/realms/{realm}/localization/{locale}/{key}',
    'description' => 'DELETE /admin/realms/{realm}/localization/{locale}/{key}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'key' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `key`.',
      ),
      'locale' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `locale`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'key' => 'key',
      'locale' => 'locale',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/organizations/{org-id}',
    'summary' => 'Deletes the organization',
    'description' => 'Deletes the organization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_groups_group_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id_groups_group_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdGroupsGroupId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}',
    'summary' => 'Delete the organization group',
    'description' => 'Deletes the organization group and all its subgroups',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_groups_group_id_members_user_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id_groups_group_id_members_user_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembersUserId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/members/{userId}',
    'summary' => 'Remove a user from this organization group',
    'description' => 'Removes a user from this organization group. The user remains a member of the organization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `userId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'group-id' => 'group_id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_identity_providers_alias' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id_identity_providers_alias',
    'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAlias',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/identity-providers/{alias}',
    'summary' => 'Removes the identity provider with the specified alias from the organization',
    'description' => 'Breaks the association between the identity provider and the organization. The provider itself is not deleted. If no provider is found, or if it is not currently associated with the org, an error response is returned',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_invitations_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id_invitations_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdInvitationsId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/invitations/{id}',
    'summary' => 'Delete an invitation',
    'description' => 'Delete an invitation.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_organizations_org_id_members_member_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id_members_member_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdMembersMemberId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/members/{member-id}',
    'summary' => 'Removes the user with the specified id from the organization',
    'description' => 'Breaks the association between the user and organization. The user itself is deleted in case the membership is managed, otherwise the user is not deleted. If no user is found, or if they are not a member of the organization, an error response is returned',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'member_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `member-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'member-id' => 'member_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_roles_by_id_role_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_roles_by_id_role_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmRolesByIdRoleId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}',
    'summary' => 'Delete the role',
    'description' => 'Delete the role.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of role',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_roles_by_id_role_id_composites' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_roles_by_id_role_id_composites',
    'class' => 'KeycloakDeleteAdminRealmsRealmRolesByIdRoleIdComposites',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/composites',
    'summary' => 'Remove a set of roles from the role\'s composite',
    'description' => 'Remove a set of roles from the role\'s composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Role id',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_roles_role_name' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_roles_role_name',
    'class' => 'KeycloakDeleteAdminRealmsRealmRolesRoleName',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/roles/{role-name}',
    'summary' => 'Delete a role by name',
    'description' => 'Delete a role by name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_roles_role_name_composites' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_roles_role_name_composites',
    'class' => 'KeycloakDeleteAdminRealmsRealmRolesRoleNameComposites',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/roles/{role-name}/composites',
    'summary' => 'Remove roles from the role\'s composite',
    'description' => 'Remove roles from the role\'s composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_sessions_session' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_sessions_session',
    'class' => 'KeycloakDeleteAdminRealmsRealmSessionsSession',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/sessions/{session}',
    'summary' => 'Remove a specific user session',
    'description' => 'Any client that has an admin url will also be told to invalidate this particular session.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'session' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `session`.',
      ),
      'is_offline' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `isOffline`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'session' => 'session',
    ),
    'query_params' =>
    array (
      'isOffline' => 'is_offline',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_users_user_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/users/{user-id}',
    'summary' => 'Delete the user',
    'description' => 'Delete the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_consents_client' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_consents_client',
    'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdConsentsClient',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/users/{user-id}/consents/{client}',
    'summary' => 'Revoke consent and offline tokens for particular client from user',
    'description' => 'Revoke consent and offline tokens for particular client from user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Client id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_credentials_credential_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_credentials_credential_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdCredentialsCredentialId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/users/{user-id}/credentials/{credentialId}',
    'summary' => 'Remove a credential for a user',
    'description' => 'Remove a credential for a user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'credential_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `credentialId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'credentialId' => 'credential_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_federated_identity_provider' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_federated_identity_provider',
    'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdFederatedIdentityProvider',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/users/{user-id}/federated-identity/{provider}',
    'summary' => 'Remove a social login provider from user',
    'description' => 'Remove a social login provider from user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'provider' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Social login provider id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'provider' => 'provider',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_groups_group_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_groups_group_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdGroupsGroupId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/users/{user-id}/groups/{groupId}',
    'summary' => 'DELETE /admin/realms/{realm}/users/{user-id}/groups/{groupId}',
    'description' => 'DELETE /admin/realms/{realm}/users/{user-id}/groups/{groupId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `groupId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'groupId' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_role_mappings_clients_client_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_role_mappings_clients_client_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id}',
    'summary' => 'Delete client-level roles from user or group role mapping',
    'description' => 'Delete client-level roles from user or group role mapping.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_users_user_id_role_mappings_realm' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_role_mappings_realm',
    'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdRoleMappingsRealm',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/realm',
    'summary' => 'Delete realm-level role mappings',
    'description' => 'Delete realm-level role mappings.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_delete_admin_realms_realm_workflows_id' =>
  array (
    'slug' => 'keycloak_delete_admin_realms_realm_workflows_id',
    'class' => 'KeycloakDeleteAdminRealmsRealmWorkflowsId',
    'method' => 'DELETE',
    'path' => '/admin/realms/{realm}/workflows/{id}',
    'summary' => 'Delete workflow',
    'description' => 'Delete the workflow and its configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow identifier',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_get_admin_realms' =>
  array (
    'slug' => 'keycloak_get_admin_realms',
    'class' => 'KeycloakGetAdminRealms',
    'method' => 'GET',
    'path' => '/admin/realms',
    'summary' => 'Get accessible realms Returns a list of accessible realms. The list is filtered based on what realms the caller is allowed to view',
    'description' => 'Get accessible realms Returns a list of accessible realms. The list is filtered based on what realms the caller is allowed to view.',
    'parameters' =>
    array (
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `briefRepresentation`.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm',
    'class' => 'KeycloakGetAdminRealmsRealm',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}',
    'summary' => 'Get the top-level representation of the realm It will not include nested information like User and Client representations',
    'description' => 'Get the top-level representation of the realm It will not include nested information like User and Client representations.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_admin_events' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_admin_events',
    'class' => 'KeycloakGetAdminRealmsRealmAdminEvents',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/admin-events',
    'summary' => 'Get admin events Returns all admin events, or filters events based on URL query parameters listed here',
    'description' => 'Get admin events Returns all admin events, or filters events based on URL query parameters listed here.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'auth_client' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `authClient`.',
      ),
      'auth_ip_address' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `authIpAddress`.',
      ),
      'auth_realm' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `authRealm`.',
      ),
      'auth_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'user id',
      ),
      'date_from' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'From (inclusive) date (yyyy-MM-dd) or time in Epoch timestamp millis (number of milliseconds since January 1, 1970, 00:00:00 GMT)',
      ),
      'date_to' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'To (inclusive) date (yyyy-MM-dd) or time in Epoch timestamp millis (number of milliseconds since January 1, 1970, 00:00:00 GMT)',
      ),
      'direction' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The direction to sort events by (asc or desc)',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum results size (defaults to 100)',
      ),
      'operation_types' =>
      array (
        'type' => 'array',
        'required' => false,
        'description' => 'Official Keycloak query parameter `operationTypes`.',
      ),
      'resource_path' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `resourcePath`.',
      ),
      'resource_types' =>
      array (
        'type' => 'array',
        'required' => false,
        'description' => 'Official Keycloak query parameter `resourceTypes`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'authClient' => 'auth_client',
      'authIpAddress' => 'auth_ip_address',
      'authRealm' => 'auth_realm',
      'authUser' => 'auth_user',
      'dateFrom' => 'date_from',
      'dateTo' => 'date_to',
      'direction' => 'direction',
      'first' => 'first',
      'max' => 'max',
      'operationTypes' => 'operation_types',
      'resourcePath' => 'resource_path',
      'resourceTypes' => 'resource_types',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_attack_detection_brute_force_users_user_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_attack_detection_brute_force_users_user_id',
    'class' => 'KeycloakGetAdminRealmsRealmAttackDetectionBruteForceUsersUserId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/attack-detection/brute-force/users/{userId}',
    'summary' => 'Get status of a username in brute force detection',
    'description' => 'Get status of a username in brute force detection.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `userId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_authenticator_providers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_authenticator_providers',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationAuthenticatorProviders',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/authenticator-providers',
    'summary' => 'Get authenticator providers Returns a stream of authenticator providers',
    'description' => 'Get authenticator providers Returns a stream of authenticator providers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_client_authenticator_providers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_client_authenticator_providers',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationClientAuthenticatorProviders',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/client-authenticator-providers',
    'summary' => 'Get client authenticator providers Returns a stream of client authenticator providers',
    'description' => 'Get client authenticator providers Returns a stream of client authenticator providers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_config_description_provider_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_config_description_provider_id',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationConfigDescriptionProviderId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/config-description/{providerId}',
    'summary' => 'Get authenticator provider\'s configuration description',
    'description' => 'Get authenticator provider\'s configuration description.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'provider_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `providerId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'providerId' => 'provider_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_config_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_config_id',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationConfigId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/config/{id}',
    'summary' => 'Get authenticator configuration',
    'description' => 'Get authenticator configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Configuration id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_executions_execution_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_executions_execution_id',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationExecutionsExecutionId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/executions/{executionId}',
    'summary' => 'Get Single Execution',
    'description' => 'Get Single Execution.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'execution_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `executionId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'executionId' => 'execution_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_executions_execution_id_config_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_executions_execution_id_config_id',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationExecutionsExecutionIdConfigId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/executions/{executionId}/config/{id}',
    'summary' => 'Get execution\'s configuration',
    'description' => 'Get execution\'s configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'execution_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Execution id',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Configuration id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'executionId' => 'execution_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_flows' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_flows',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFlows',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/flows',
    'summary' => 'Get authentication flows Returns a stream of authentication flows',
    'description' => 'Get authentication flows Returns a stream of authentication flows.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_flows_flow_alias_executions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_flows_flow_alias_executions',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFlowsFlowAliasExecutions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/flows/{flowAlias}/executions',
    'summary' => 'Get authentication executions for a flow',
    'description' => 'Get authentication executions for a flow.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'flow_alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Flow alias',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'flowAlias' => 'flow_alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_flows_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_flows_id',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFlowsId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/flows/{id}',
    'summary' => 'Get authentication flow for id',
    'description' => 'Get authentication flow for id.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Flow id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_form_action_providers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_form_action_providers',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFormActionProviders',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/form-action-providers',
    'summary' => 'Get form action providers Returns a stream of form action providers',
    'description' => 'Get form action providers Returns a stream of form action providers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_form_providers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_form_providers',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFormProviders',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/form-providers',
    'summary' => 'Get form providers Returns a stream of form providers',
    'description' => 'Get form providers Returns a stream of form providers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_per_client_config_description' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_per_client_config_description',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationPerClientConfigDescription',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/per-client-config-description',
    'summary' => 'Get configuration descriptions for all clients',
    'description' => 'Get configuration descriptions for all clients.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_required_actions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_required_actions',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationRequiredActions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/required-actions',
    'summary' => 'Get required actions Returns a stream of required actions',
    'description' => 'Get required actions Returns a stream of required actions.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_required_actions_alias' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_required_actions_alias',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAlias',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}',
    'summary' => 'Get required action for alias',
    'description' => 'Get required action for alias.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of required action',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_required_actions_alias_config' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_required_actions_alias_config',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAliasConfig',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/config',
    'summary' => 'Get RequiredAction configuration',
    'description' => 'Get RequiredAction configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of required action',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_required_actions_alias_config_description' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_required_actions_alias_config_description',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAliasConfigDescription',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/config-description',
    'summary' => 'Get RequiredAction provider configuration description',
    'description' => 'Get RequiredAction provider configuration description.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of required action',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_authentication_unregistered_required_actions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_authentication_unregistered_required_actions',
    'class' => 'KeycloakGetAdminRealmsRealmAuthenticationUnregisteredRequiredActions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/authentication/unregistered-required-actions',
    'summary' => 'Get unregistered required actions Returns a stream of unregistered required actions',
    'description' => 'Get unregistered required actions Returns a stream of unregistered required actions.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_policies_policies' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_policies_policies',
    'class' => 'KeycloakGetAdminRealmsRealmClientPoliciesPolicies',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-policies/policies',
    'summary' => 'GET /admin/realms/{realm}/client-policies/policies',
    'description' => 'GET /admin/realms/{realm}/client-policies/policies.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'include_global_policies' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `include-global-policies`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'include-global-policies' => 'include_global_policies',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_policies_profiles' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_policies_profiles',
    'class' => 'KeycloakGetAdminRealmsRealmClientPoliciesProfiles',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-policies/profiles',
    'summary' => 'GET /admin/realms/{realm}/client-policies/profiles',
    'description' => 'GET /admin/realms/{realm}/client-policies/profiles.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'include_global_profiles' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `include-global-profiles`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'include-global-profiles' => 'include_global_profiles',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_registration_policy_providers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_registration_policy_providers',
    'class' => 'KeycloakGetAdminRealmsRealmClientRegistrationPolicyProviders',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-registration-policy/providers',
    'summary' => 'Base path for retrieve providers with the configProperties properly filled',
    'description' => 'Base path for retrieve providers with the configProperties properly filled.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes',
    'summary' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm',
    'description' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}',
    'summary' => 'Get representation of the client scope',
    'description' => 'Get representation of the client scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModels',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/models',
    'summary' => 'Get mappers',
    'description' => 'Get mappers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModelsId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/models/{id}',
    'summary' => 'Get mapper by id',
    'description' => 'Get mapper by id.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_protocol_protocol' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_protocol_protocol',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersProtocolProtocol',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/protocol/{protocol}',
    'summary' => 'Get mappers by name for a specific protocol',
    'description' => 'Get mappers by name for a specific protocol.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'protocol' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `protocol`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'protocol' => 'protocol',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappings',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings',
    'summary' => 'Get all scope mappings for the client',
    'description' => 'Get all scope mappings for the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClient',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/clients/{client}',
    'summary' => 'Get the roles associated with a client\'s scope Returns roles for the client',
    'description' => 'Get the roles associated with a client\'s scope Returns roles for the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client_available',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClientAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/clients/{client}/available',
    'summary' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope',
    'description' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client_composite',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClientComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/clients/{client}/composite',
    'summary' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope',
    'description' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealm',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/realm',
    'summary' => 'Get realm-level roles associated with the client\'s scope',
    'description' => 'Get realm-level roles associated with the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm_available',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealmAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/realm/available',
    'summary' => 'Get realm-level roles that are available to attach to this client\'s scope',
    'description' => 'Get realm-level roles that are available to attach to this client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm_composite',
    'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealmComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/realm/composite',
    'summary' => 'Get effective realm-level roles associated with the client’s scope What this does is recurse any composite roles associated with the client’s scope and adds the roles to this lists',
    'description' => 'The method is really to show a comprehensive total view of realm-level roles associated with the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_session_stats' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_session_stats',
    'class' => 'KeycloakGetAdminRealmsRealmClientSessionStats',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-session-stats',
    'summary' => 'Get client session stats Returns a JSON map',
    'description' => 'The key is the client id, the value is the number of sessions that currently are active with that client. Only clients that actually have a session associated with them will be in this map.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplates',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates',
    'summary' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm',
    'description' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}',
    'summary' => 'Get representation of the client scope',
    'description' => 'Get representation of the client scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModels',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/protocol-mappers/models',
    'summary' => 'Get mappers',
    'description' => 'Get mappers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModelsId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/protocol-mappers/models/{id}',
    'summary' => 'Get mapper by id',
    'description' => 'Get mapper by id.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_protocol_protocol' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_protocol_protocol',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersProtocolProtocol',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/protocol-mappers/protocol/{protocol}',
    'summary' => 'Get mappers by name for a specific protocol',
    'description' => 'Get mappers by name for a specific protocol.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'protocol' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `protocol`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'protocol' => 'protocol',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappings',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings',
    'summary' => 'Get all scope mappings for the client',
    'description' => 'Get all scope mappings for the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClient',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/clients/{client}',
    'summary' => 'Get the roles associated with a client\'s scope Returns roles for the client',
    'description' => 'Get the roles associated with a client\'s scope Returns roles for the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client_available',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClientAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/clients/{client}/available',
    'summary' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope',
    'description' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client_composite',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClientComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/clients/{client}/composite',
    'summary' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope',
    'description' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealm',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/realm',
    'summary' => 'Get realm-level roles associated with the client\'s scope',
    'description' => 'Get realm-level roles associated with the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm_available',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealmAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/realm/available',
    'summary' => 'Get realm-level roles that are available to attach to this client\'s scope',
    'description' => 'Get realm-level roles that are available to attach to this client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm_composite',
    'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealmComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/realm/composite',
    'summary' => 'Get effective realm-level roles associated with the client’s scope What this does is recurse any composite roles associated with the client’s scope and adds the roles to this lists',
    'description' => 'The method is really to show a comprehensive total view of realm-level roles associated with the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_client_types' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_client_types',
    'class' => 'KeycloakGetAdminRealmsRealmClientTypes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/client-types',
    'summary' => 'List all client types available in the current realm',
    'description' => 'This endpoint returns a list of both global and realm level client types and the attributes they set',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients',
    'class' => 'KeycloakGetAdminRealmsRealmClients',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients',
    'summary' => 'Get clients belonging to the realm',
    'description' => 'If a client can’t be retrieved from the storage due to a problem with the underlying storage, it is silently removed from the returned list. This ensures that concurrent modifications to the list don’t prevent callers from retrieving this list.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'filter by clientId',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'the first result',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'the max results to return',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `q`.',
      ),
      'search' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'whether this is a search query or a getClientById query',
      ),
      'viewable_only' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'filter clients that cannot be viewed in full by admin',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'clientId' => 'client_id',
      'first' => 'first',
      'max' => 'max',
      'q' => 'q',
      'search' => 'search',
      'viewableOnly' => 'viewable_only',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuid',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}',
    'summary' => 'Get representation of the client',
    'description' => 'Get representation of the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServer',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermission',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'fields' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `fields`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'permission' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `permission`.',
      ),
      'policy_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `policyId`.',
      ),
      'resource' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `resource`.',
      ),
      'resource_type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `resourceType`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'fields' => 'fields',
      'first' => 'first',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'permission' => 'permission',
      'policyId' => 'policy_id',
      'resource' => 'resource',
      'resourceType' => 'resource_type',
      'scope' => 'scope',
      'type' => 'type',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_providers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_providers',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionProviders',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_search' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_search',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionSearch',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'fields' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `fields`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'fields' => 'fields',
      'name' => 'name',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicy',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'fields' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `fields`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'permission' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `permission`.',
      ),
      'policy_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `policyId`.',
      ),
      'resource' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `resource`.',
      ),
      'resource_type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `resourceType`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'fields' => 'fields',
      'first' => 'first',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'permission' => 'permission',
      'policyId' => 'policy_id',
      'resource' => 'resource',
      'resourceType' => 'resource_type',
      'scope' => 'scope',
      'type' => 'type',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy_providers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy_providers',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicyProviders',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/providers',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/providers',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/providers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy_search' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy_search',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicySearch',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/search',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/search',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/search.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'fields' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `fields`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'fields' => 'fields',
      'name' => 'name',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResource',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `_id`.',
      ),
      'deep' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `deep`.',
      ),
      'exact_name' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exactName`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'matching_uri' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `matchingUri`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
      'uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `uri`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      '_id' => 'id',
      'deep' => 'deep',
      'exactName' => 'exact_name',
      'first' => 'first',
      'matchingUri' => 'matching_uri',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'scope' => 'scope',
      'type' => 'type',
      'uri' => 'uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `_id`.',
      ),
      'deep' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `deep`.',
      ),
      'exact_name' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exactName`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'matching_uri' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `matchingUri`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
      'uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `uri`.',
      ),
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `resource-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'resource-id' => 'resource_id',
    ),
    'query_params' =>
    array (
      '_id' => 'id',
      'deep' => 'deep',
      'exactName' => 'exact_name',
      'first' => 'first',
      'matchingUri' => 'matching_uri',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'scope' => 'scope',
      'type' => 'type',
      'uri' => 'uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id_attributes' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id_attributes',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceIdAttributes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/attributes',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/attributes',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/attributes.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `_id`.',
      ),
      'deep' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `deep`.',
      ),
      'exact_name' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exactName`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'matching_uri' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `matchingUri`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
      'uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `uri`.',
      ),
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `resource-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'resource-id' => 'resource_id',
    ),
    'query_params' =>
    array (
      '_id' => 'id',
      'deep' => 'deep',
      'exactName' => 'exact_name',
      'first' => 'first',
      'matchingUri' => 'matching_uri',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'scope' => 'scope',
      'type' => 'type',
      'uri' => 'uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id_permissions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id_permissions',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceIdPermissions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/permissions',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/permissions',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/permissions.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `_id`.',
      ),
      'deep' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `deep`.',
      ),
      'exact_name' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exactName`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'matching_uri' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `matchingUri`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
      'uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `uri`.',
      ),
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `resource-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'resource-id' => 'resource_id',
    ),
    'query_params' =>
    array (
      '_id' => 'id',
      'deep' => 'deep',
      'exactName' => 'exact_name',
      'first' => 'first',
      'matchingUri' => 'matching_uri',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'scope' => 'scope',
      'type' => 'type',
      'uri' => 'uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id_scopes' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id_scopes',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceIdScopes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/scopes',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/scopes',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}/scopes.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `_id`.',
      ),
      'deep' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `deep`.',
      ),
      'exact_name' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exactName`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'matching_uri' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `matchingUri`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
      'uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `uri`.',
      ),
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `resource-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'resource-id' => 'resource_id',
    ),
    'query_params' =>
    array (
      '_id' => 'id',
      'deep' => 'deep',
      'exactName' => 'exact_name',
      'first' => 'first',
      'matchingUri' => 'matching_uri',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'scope' => 'scope',
      'type' => 'type',
      'uri' => 'uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_search' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_search',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceSearch',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `_id`.',
      ),
      'deep' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `deep`.',
      ),
      'exact_name' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exactName`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'matching_uri' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `matchingUri`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
      'uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `uri`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      '_id' => 'id',
      'deep' => 'deep',
      'exactName' => 'exact_name',
      'first' => 'first',
      'matchingUri' => 'matching_uri',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'scope' => 'scope',
      'type' => 'type',
      'uri' => 'uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScope',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scopeId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'first' => 'first',
      'max' => 'max',
      'name' => 'name',
      'scopeId' => 'scope_id',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'scope-id' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id_permissions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id_permissions',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeIdPermissions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'scope-id' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id_resources' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id_resources',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeIdResources',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/resources',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/resources',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/resources.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `scope-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'scope-id' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_search' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_search',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeSearch',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/search',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/search',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/search.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'name' => 'name',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_settings' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_settings',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerSettings',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_certificates_attr' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_certificates_attr',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidCertificatesAttr',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}',
    'summary' => 'Get key info',
    'description' => 'Get key info.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'attr' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `attr`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'attr' => 'attr',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_client_secret' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_client_secret',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidClientSecret',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/client-secret',
    'summary' => 'Get the client secret',
    'description' => 'Get the client secret.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_client_secret_rotated' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_client_secret_rotated',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidClientSecretRotated',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/client-secret/rotated',
    'summary' => 'Get the rotated client secret',
    'description' => 'Get the rotated client secret.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_default_client_scopes' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_default_client_scopes',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidDefaultClientScopes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/default-client-scopes',
    'summary' => 'Get default client scopes. Only name and ids are returned',
    'description' => 'Get default client scopes. Only name and ids are returned.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_access_token' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_access_token',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesGenerateExampleAccessToken',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/generate-example-access-token',
    'summary' => 'Create JSON with payload of example access token',
    'description' => 'Create JSON with payload of example access token.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'audience' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `audience`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `userId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'audience' => 'audience',
      'scope' => 'scope',
      'userId' => 'user_id',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_id_token' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_id_token',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesGenerateExampleIdToken',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/generate-example-id-token',
    'summary' => 'Create JSON with payload of example id token',
    'description' => 'Create JSON with payload of example id token.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'audience' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `audience`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `userId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'audience' => 'audience',
      'scope' => 'scope',
      'userId' => 'user_id',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_userinfo' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_userinfo',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesGenerateExampleUserinfo',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/generate-example-userinfo',
    'summary' => 'Create JSON with payload of example user info',
    'description' => 'Create JSON with payload of example user info.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `userId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'scope' => 'scope',
      'userId' => 'user_id',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_protocol_mappers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_protocol_mappers',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesProtocolMappers',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/protocol-mappers',
    'summary' => 'Return list of all protocol mappers, which will be used when generating tokens issued for particular client',
    'description' => 'This means protocol mappers assigned to this client directly and protocol mappers assigned to all client scopes of this client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'scope' => 'scope',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_scope_mappings_role_container_id_granted' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_scope_mappings_role_container_id_granted',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesScopeMappingsRoleContainerIdGranted',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/scope-mappings/{roleContainerId}/granted',
    'summary' => 'Get effective scope mapping of all roles of particular role container, which this client is defacto allowed to have in the accessToken issued for him',
    'description' => 'This contains scope mappings, which this client has directly, as well as scope mappings, which are granted to all client scopes, which are linked with this client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_container_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'either realm name OR client UUID',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'roleContainerId' => 'role_container_id',
    ),
    'query_params' =>
    array (
      'scope' => 'scope',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_scope_mappings_role_container_id_not_granted' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_scope_mappings_role_container_id_not_granted',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesScopeMappingsRoleContainerIdNotGranted',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/scope-mappings/{roleContainerId}/not-granted',
    'summary' => 'Get roles, which this client doesn\'t have scope for and can\'t have them in the accessToken issued for him',
    'description' => 'Defacto all the other roles of particular role container, which are not in {@link #getGrantedScopeMappings()}',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_container_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'either realm name OR client UUID',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'roleContainerId' => 'role_container_id',
    ),
    'query_params' =>
    array (
      'scope' => 'scope',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_installation_providers_provider_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_installation_providers_provider_id',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidInstallationProvidersProviderId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId}',
    'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId}',
    'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/installation/providers/{providerId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'provider_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `providerId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'providerId' => 'provider_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_management_permissions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_management_permissions',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidManagementPermissions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/management/permissions',
    'summary' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_offline_session_count' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_offline_session_count',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidOfflineSessionCount',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/offline-session-count',
    'summary' => 'Get application offline session count Returns a number of offline user sessions associated with this client { "count": number }',
    'description' => 'Get application offline session count Returns a number of offline user sessions associated with this client { "count": number }.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_offline_sessions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_offline_sessions',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidOfflineSessions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/offline-sessions',
    'summary' => 'Get offline sessions for client Returns a list of offline user sessions associated with this client',
    'description' => 'Get offline sessions for client Returns a list of offline user sessions associated with this client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Paging offset',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum results size (defaults to 100)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'first' => 'first',
      'max' => 'max',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_optional_client_scopes' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_optional_client_scopes',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidOptionalClientScopes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes',
    'summary' => 'Get optional client scopes. Only name and ids are returned',
    'description' => 'Get optional client scopes. Only name and ids are returned.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_models' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_models',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidProtocolMappersModels',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/models',
    'summary' => 'Get mappers',
    'description' => 'Get mappers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidProtocolMappersModelsId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/models/{id}',
    'summary' => 'Get mapper by id',
    'description' => 'Get mapper by id.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_protocol_protocol' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_protocol_protocol',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidProtocolMappersProtocolProtocol',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/protocol/{protocol}',
    'summary' => 'Get mappers by name for a specific protocol',
    'description' => 'Get mappers by name for a specific protocol.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'protocol' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `protocol`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'protocol' => 'protocol',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRoles',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles',
    'summary' => 'Get all roles for the realm or client',
    'description' => 'Get all roles for the realm or client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `briefRepresentation`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleName',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}',
    'summary' => 'Get a role by name',
    'description' => 'Get a role by name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameComposites',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites',
    'summary' => 'Get composites of the role',
    'description' => 'Get composites of the role.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites_clients_target_client_uuid' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites_clients_target_client_uuid',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameCompositesClientsTargetClientUuid',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites/clients/{targetClientUuid}',
    'summary' => 'Get client-level roles for the client that are in the role\'s composite',
    'description' => 'Get client-level roles for the client that are in the role\'s composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
      'target_client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `targetClientUuid`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
      'targetClientUuid' => 'target_client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites_realm' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites_realm',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameCompositesRealm',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites/realm',
    'summary' => 'Get realm-level roles of the role\'s composite',
    'description' => 'Get realm-level roles of the role\'s composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_groups' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_groups',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameGroups',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/groups',
    'summary' => 'Returns a stream of groups that have the specified role name',
    'description' => 'Returns a stream of groups that have the specified role name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'the role name.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return a full representation of the {@code GroupRepresentation} objects.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'first result to return. Ignored if negative or {@code null}.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'maximum number of results to return. Ignored if negative or {@code null}.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_management_permissions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_management_permissions',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameManagementPermissions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/management/permissions',
    'summary' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-name`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_users' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_users',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameUsers',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/users',
    'summary' => 'Returns a stream of users that have the specified role name',
    'description' => 'Returns a stream of users that have the specified role name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'the role name.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether brief representations are returned (default: false)',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'first result to return. Ignored if negative or {@code null}.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'maximum number of results to return. Ignored if negative or {@code null}.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappings',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings',
    'summary' => 'Get all scope mappings for the client',
    'description' => 'Get all scope mappings for the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClient',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}',
    'summary' => 'Get the roles associated with a client\'s scope Returns roles for the client',
    'description' => 'Get the roles associated with a client\'s scope Returns roles for the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client_available',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClientAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}/available',
    'summary' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope',
    'description' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client_composite',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClientComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}/composite',
    'summary' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope',
    'description' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'client' => 'client',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealm',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm',
    'summary' => 'Get realm-level roles associated with the client\'s scope',
    'description' => 'Get realm-level roles associated with the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm_available',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealmAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm/available',
    'summary' => 'Get realm-level roles that are available to attach to this client\'s scope',
    'description' => 'Get realm-level roles that are available to attach to this client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm_composite',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealmComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm/composite',
    'summary' => 'Get effective realm-level roles associated with the client’s scope What this does is recurse any composite roles associated with the client’s scope and adds the roles to this lists',
    'description' => 'The method is really to show a comprehensive total view of realm-level roles associated with the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_service_account_user' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_service_account_user',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidServiceAccountUser',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/service-account-user',
    'summary' => 'Get a user dedicated to the service account',
    'description' => 'Get a user dedicated to the service account.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_session_count' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_session_count',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidSessionCount',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/session-count',
    'summary' => 'Get application session count Returns a number of user sessions associated with this client { "count": number }',
    'description' => 'Get application session count Returns a number of user sessions associated with this client { "count": number }.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_test_nodes_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_test_nodes_available',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidTestNodesAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/test-nodes-available',
    'summary' => 'Test if registered cluster nodes are available Tests availability by sending \'ping\' request to all cluster nodes',
    'description' => 'Test if registered cluster nodes are available Tests availability by sending \'ping\' request to all cluster nodes.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_client_uuid_user_sessions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_user_sessions',
    'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidUserSessions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/user-sessions',
    'summary' => 'Get user sessions for client Returns a list of user sessions associated with this client',
    'description' => 'Get user sessions for client Returns a list of user sessions associated with this client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Paging offset',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum results size (defaults to 100)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      'first' => 'first',
      'max' => 'max',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_clients_initial_access' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_clients_initial_access',
    'class' => 'KeycloakGetAdminRealmsRealmClientsInitialAccess',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/clients-initial-access',
    'summary' => 'GET /admin/realms/{realm}/clients-initial-access',
    'description' => 'GET /admin/realms/{realm}/clients-initial-access.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_components' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_components',
    'class' => 'KeycloakGetAdminRealmsRealmComponents',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/components',
    'summary' => 'GET /admin/realms/{realm}/components',
    'description' => 'GET /admin/realms/{realm}/components.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'parent' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `parent`.',
      ),
      'provider_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `providerId`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'name' => 'name',
      'parent' => 'parent',
      'providerId' => 'provider_id',
      'type' => 'type',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_components_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_components_id',
    'class' => 'KeycloakGetAdminRealmsRealmComponentsId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/components/{id}',
    'summary' => 'GET /admin/realms/{realm}/components/{id}',
    'description' => 'GET /admin/realms/{realm}/components/{id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_components_id_sub_component_types' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_components_id_sub_component_types',
    'class' => 'KeycloakGetAdminRealmsRealmComponentsIdSubComponentTypes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/components/{id}/sub-component-types',
    'summary' => 'List of subcomponent types that are available to configure for a particular parent component',
    'description' => 'List of subcomponent types that are available to configure for a particular parent component.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'type' => 'type',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_credential_registrators' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_credential_registrators',
    'class' => 'KeycloakGetAdminRealmsRealmCredentialRegistrators',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/credential-registrators',
    'summary' => 'GET /admin/realms/{realm}/credential-registrators',
    'description' => 'GET /admin/realms/{realm}/credential-registrators.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_default_default_client_scopes' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_default_default_client_scopes',
    'class' => 'KeycloakGetAdminRealmsRealmDefaultDefaultClientScopes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/default-default-client-scopes',
    'summary' => 'Get realm default client scopes. Only name and ids are returned',
    'description' => 'Get realm default client scopes. Only name and ids are returned.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_default_groups' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_default_groups',
    'class' => 'KeycloakGetAdminRealmsRealmDefaultGroups',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/default-groups',
    'summary' => 'Get group hierarchy. Only name and ids are returned',
    'description' => 'Get group hierarchy. Only name and ids are returned.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_default_optional_client_scopes' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_default_optional_client_scopes',
    'class' => 'KeycloakGetAdminRealmsRealmDefaultOptionalClientScopes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/default-optional-client-scopes',
    'summary' => 'Get realm optional client scopes. Only name and ids are returned',
    'description' => 'Get realm optional client scopes. Only name and ids are returned.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_events' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_events',
    'class' => 'KeycloakGetAdminRealmsRealmEvents',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/events',
    'summary' => 'Get events Returns all events, or filters them based on URL query parameters listed here',
    'description' => 'Get events Returns all events, or filters them based on URL query parameters listed here.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'App or oauth client name',
      ),
      'date_from' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'From (inclusive) date (yyyy-MM-dd) or time in Epoch timestamp millis (number of milliseconds since January 1, 1970, 00:00:00 GMT)',
      ),
      'date_to' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'To (inclusive) date (yyyy-MM-dd) or time in Epoch timestamp millis (number of milliseconds since January 1, 1970, 00:00:00 GMT)',
      ),
      'direction' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The direction to sort events by (asc or desc)',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Paging offset',
      ),
      'ip_address' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'IP Address',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum results size (defaults to 100)',
      ),
      'type' =>
      array (
        'type' => 'array',
        'required' => false,
        'description' => 'The types of events to return',
      ),
      'user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'User id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'client' => 'client',
      'dateFrom' => 'date_from',
      'dateTo' => 'date_to',
      'direction' => 'direction',
      'first' => 'first',
      'ipAddress' => 'ip_address',
      'max' => 'max',
      'type' => 'type',
      'user' => 'user',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_events_config' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_events_config',
    'class' => 'KeycloakGetAdminRealmsRealmEventsConfig',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/events/config',
    'summary' => 'Get the events provider configuration Returns JSON object with events provider configuration',
    'description' => 'Get the events provider configuration Returns JSON object with events provider configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_group_by_path_path' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_group_by_path_path',
    'class' => 'KeycloakGetAdminRealmsRealmGroupByPathPath',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/group-by-path/{path}',
    'summary' => 'GET /admin/realms/{realm}/group-by-path/{path}',
    'description' => 'GET /admin/realms/{realm}/group-by-path/{path}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'path' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `path`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'path' => 'path',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups',
    'class' => 'KeycloakGetAdminRealmsRealmGroups',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups',
    'summary' => 'Get group hierarchy. Only `name` and `id` are returned. `subGroups` are only returned when using the `search` or `q` parameter. If none of these parameters is provided, the top-level groups are returned without `subGroups` being filled',
    'description' => 'Get group hierarchy. Only `name` and `id` are returned. `subGroups` are only returned when using the `search` or `q` parameter. If none of these parameters is provided, the top-level groups are returned without `subGroups` being filled.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `briefRepresentation`.',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exact`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'populate_hierarchy' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `populateHierarchy`.',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `q`.',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
      'sub_groups_count' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether to return the count of subgroups for each group (default: true',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'exact' => 'exact',
      'first' => 'first',
      'max' => 'max',
      'populateHierarchy' => 'populate_hierarchy',
      'q' => 'q',
      'search' => 'search',
      'subGroupsCount' => 'sub_groups_count',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_count' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_count',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsCount',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/count',
    'summary' => 'Returns the groups counts',
    'description' => 'Returns the groups counts.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
      'top' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `top`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'search' => 'search',
      'top' => 'top',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}',
    'summary' => 'GET /admin/realms/{realm}/groups/{group-id}',
    'description' => 'GET /admin/realms/{realm}/groups/{group-id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_children' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_children',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdChildren',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/children',
    'summary' => 'Return a paginated list of subgroups that have a parent group corresponding to the group on the URL',
    'description' => 'Return a paginated list of subgroups that have a parent group corresponding to the group on the URL.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether brief groups representations are returned or not (default: false)',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether the params "search" must match exactly or not',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The position of the first result to be returned (pagination offset).',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of results that are to be returned. Defaults to 10',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String representing either an exact group name or a partial name, defaults to prefix search.',
      ),
      'sub_groups_count' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether to return the count of subgroups for each subgroup of this group (default: true)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'exact' => 'exact',
      'first' => 'first',
      'max' => 'max',
      'search' => 'search',
      'subGroupsCount' => 'sub_groups_count',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_management_permissions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_management_permissions',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdManagementPermissions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/management/permissions',
    'summary' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_members' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_members',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdMembers',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/members',
    'summary' => 'Get users Returns a stream of users, filtered according to query parameters',
    'description' => 'Get users Returns a stream of users, filtered according to query parameters.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Only return basic information (only guaranteed to return id, username, created, first and last name, email, enabled state, email verification state, federation link, and access. Note that it means that namely user attributes, required actions, and not before are not returned.)',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination offset',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum results size (defaults to 100)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappings',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings',
    'summary' => 'Get role mappings',
    'description' => 'Get role mappings.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id}',
    'summary' => 'Get client-level role mappings for the user or group, and the app',
    'description' => 'Get client-level role mappings for the user or group, and the app.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id_available',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientIdAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id}/available',
    'summary' => 'Get available client-level roles that can be mapped to the user or group',
    'description' => 'Get available client-level roles that can be mapped to the user or group.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id_composite',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientIdComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id}/composite',
    'summary' => 'Get effective client-level role mappings This recurses any composite roles',
    'description' => 'Get effective client-level role mappings This recurses any composite roles.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsRealm',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/realm',
    'summary' => 'Get realm-level role mappings',
    'description' => 'Get realm-level role mappings.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm_available',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsRealmAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/realm/available',
    'summary' => 'Get realm-level roles that can be mapped',
    'description' => 'Get realm-level roles that can be mapped.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm_composite',
    'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsRealmComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/realm/composite',
    'summary' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result',
    'description' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances',
    'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstances',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/identity-provider/instances',
    'summary' => 'List identity providers',
    'description' => 'List identity providers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether brief representations are returned (default: false)',
      ),
      'capability' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by identity providers capability',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination offset',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum results size (defaults to 100)',
      ),
      'realm_only' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines if only realm-level IDPs (not associated with orgs) should be returned (default: false)',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter specific providers by name. Search can be prefix (name*), contains (*name*) or exact ("name"). Default prefixed.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by identity providers type',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'capability' => 'capability',
      'first' => 'first',
      'max' => 'max',
      'realmOnly' => 'realm_only',
      'search' => 'search',
      'type' => 'type',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias',
    'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAlias',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}',
    'summary' => 'Get the identity provider',
    'description' => 'Get the identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_export' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_export',
    'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasExport',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/export',
    'summary' => 'Export public broker configuration for identity provider',
    'description' => 'Export public broker configuration for identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
      'format' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Format to use',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
      'format' => 'format',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_management_permissions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_management_permissions',
    'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasManagementPermissions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/management/permissions',
    'summary' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mapper_types' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mapper_types',
    'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMapperTypes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mapper-types',
    'summary' => 'Get mapper types for identity provider',
    'description' => 'Get mapper types for identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mappers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mappers',
    'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMappers',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers',
    'summary' => 'Get mappers for identity provider',
    'description' => 'Get mappers for identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mappers_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mappers_id',
    'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMappersId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers/{id}',
    'summary' => 'Get mapper by id for the identity provider',
    'description' => 'Get mapper by id for the identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_instances_alias_reload_keys' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_reload_keys',
    'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasReloadKeys',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/reload-keys',
    'summary' => 'Reaload keys for the identity provider if the provider supports it, "true" is returned if reload was performed, "false" if not',
    'description' => 'Reaload keys for the identity provider if the provider supports it, "true" is returned if reload was performed, "false" if not.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_identity_provider_providers_provider_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_identity_provider_providers_provider_id',
    'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderProvidersProviderId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/identity-provider/providers/{provider_id}',
    'summary' => 'Get the identity provider factory for that provider id',
    'description' => 'Get the identity provider factory for that provider id.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'provider_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The provider id to get the factory',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'provider_id' => 'provider_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_keys' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_keys',
    'class' => 'KeycloakGetAdminRealmsRealmKeys',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/keys',
    'summary' => 'GET /admin/realms/{realm}/keys',
    'description' => 'GET /admin/realms/{realm}/keys.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_localization' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_localization',
    'class' => 'KeycloakGetAdminRealmsRealmLocalization',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/localization',
    'summary' => 'GET /admin/realms/{realm}/localization',
    'description' => 'GET /admin/realms/{realm}/localization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_localization_locale' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_localization_locale',
    'class' => 'KeycloakGetAdminRealmsRealmLocalizationLocale',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/localization/{locale}',
    'summary' => 'GET /admin/realms/{realm}/localization/{locale}',
    'description' => 'GET /admin/realms/{realm}/localization/{locale}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'locale' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `locale`.',
      ),
      'use_realm_default_locale_fallback' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `useRealmDefaultLocaleFallback`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'locale' => 'locale',
    ),
    'query_params' =>
    array (
      'useRealmDefaultLocaleFallback' => 'use_realm_default_locale_fallback',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_localization_locale_key' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_localization_locale_key',
    'class' => 'KeycloakGetAdminRealmsRealmLocalizationLocaleKey',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/localization/{locale}/{key}',
    'summary' => 'GET /admin/realms/{realm}/localization/{locale}/{key}',
    'description' => 'GET /admin/realms/{realm}/localization/{locale}/{key}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'key' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `key`.',
      ),
      'locale' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `locale`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'key' => 'key',
      'locale' => 'locale',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizations',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations',
    'summary' => 'Returns a paginated list of organizations filtered according to the specified parameters',
    'description' => 'Returns a paginated list of organizations filtered according to the specified parameters.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return the full representation. Otherwise, only the basic fields are returned.',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether the param \'search\' must match exactly or not',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The position of the first result to be processed (pagination offset)',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of results to be returned - defaults to 10',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A query to search for custom attributes, in the format \'key1:value2 key2:value2\'',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String representing either an organization name or domain',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'exact' => 'exact',
      'first' => 'first',
      'max' => 'max',
      'q' => 'q',
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_count' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_count',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsCount',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/count',
    'summary' => 'Returns the organizations counts',
    'description' => 'Returns the organizations counts.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether the param \'search\' must match exactly or not',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A query to search for custom attributes, in the format \'key1:value2 key2:value2\'',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String representing either an organization name or domain',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'exact' => 'exact',
      'q' => 'q',
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_members_member_id_organizations' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_members_member_id_organizations',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsMembersMemberIdOrganizations',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/members/{member-id}/organizations',
    'summary' => 'Returns the organizations associated with the user that has the specified id',
    'description' => 'Returns the organizations associated with the user that has the specified id.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'member_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `member-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return the full representation. Otherwise, only the basic fields are returned.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'member-id' => 'member_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}',
    'summary' => 'Returns the organization representation',
    'description' => 'Returns the organization representation.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroups',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups',
    'summary' => 'Get organization groups',
    'description' => 'Returns organization groups. When `search` parameter is provided, groups are searched by name. When `q` parameter is provided, groups are searched by attributes. If neither parameter is provided, top-level groups are returned.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `briefRepresentation`.',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exact`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'populate_hierarchy' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `populateHierarchy`.',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `q`.',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
      'sub_groups_count' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `subGroupsCount`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'exact' => 'exact',
      'first' => 'first',
      'max' => 'max',
      'populateHierarchy' => 'populate_hierarchy',
      'q' => 'q',
      'search' => 'search',
      'subGroupsCount' => 'sub_groups_count',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_by_path_path' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_by_path_path',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupByPathPath',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/group-by-path/{path}',
    'summary' => 'Get organization group by path',
    'description' => 'Returns the organization group with the specified path',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'path' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `path`.',
      ),
      'sub_groups_count' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Whether to return the count of subgroups (default: false)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'path' => 'path',
    ),
    'query_params' =>
    array (
      'subGroupsCount' => 'sub_groups_count',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}',
    'summary' => 'Get organization group representation',
    'description' => 'Get organization group representation.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'sub_groups_count' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Whether to return the count of subgroups (default: false)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
      'subGroupsCount' => 'sub_groups_count',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id_children' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id_children',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdChildren',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/children',
    'summary' => 'Get subgroups of this organization group',
    'description' => 'Returns a paginated stream of subgroups that belong to this organization group',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether the params "search" must match exactly or not',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The position of the first result to be returned (pagination offset).',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of results that are to be returned. Defaults to 10',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String representing either an exact group name or a partial name',
      ),
      'sub_groups_count' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Whether to return the count of subgroups (default: false)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
      'exact' => 'exact',
      'first' => 'first',
      'max' => 'max',
      'search' => 'search',
      'subGroupsCount' => 'sub_groups_count',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id_members' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id_members',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembers',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/members',
    'summary' => 'Get members of this organization group',
    'description' => 'Returns a paginated list of organization members that belong to this group',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Only return basic information (only guaranteed to return id, username, created, first and last name, email, enabled state, email verification state, federation link, and access. Note that it means that namely user attributes, required actions, and not before are not returned.)',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination offset',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum results size (defaults to 100)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProviders',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/identity-providers',
    'summary' => 'Returns all identity providers associated with the organization',
    'description' => 'Returns all identity providers associated with the organization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers_alias' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers_alias',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAlias',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/identity-providers/{alias}',
    'summary' => 'Returns the identity provider associated with the organization that has the specified alias',
    'description' => 'Searches for an identity provider with the given alias. If one is found and is associated with the organization, it is returned. Otherwise, an error response with status NOT_FOUND is returned',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers_alias_groups' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers_alias_groups',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAliasGroups',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/identity-providers/{alias}/groups',
    'summary' => 'Returns organization groups for the identity provider',
    'description' => 'Returns organization groups that can be used in identity provider mappers. Only returns groups if the identity provider is associated with the organization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The alias of the identity provider',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true, return brief representation; otherwise return full representation',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true, perform exact match on the search parameter',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The position of the first result (pagination offset)',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of results to return',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A query to search for group attributes, in the format \'key1:value1 key2:value2\'',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A string to search for in group names',
      ),
      'sub_groups_count' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true, include subgroups count in the response',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'exact' => 'exact',
      'first' => 'first',
      'max' => 'max',
      'q' => 'q',
      'search' => 'search',
      'subGroupsCount' => 'sub_groups_count',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_invitations' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_invitations',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdInvitations',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/invitations',
    'summary' => 'Get invitations for the organization',
    'description' => 'Get invitations for the organization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'email' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `email`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'first_name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `firstName`.',
      ),
      'last_name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `lastName`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
      'status' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `status`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
      'email' => 'email',
      'first' => 'first',
      'firstName' => 'first_name',
      'lastName' => 'last_name',
      'max' => 'max',
      'search' => 'search',
      'status' => 'status',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_invitations_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_invitations_id',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdInvitationsId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/invitations/{id}',
    'summary' => 'Get invitation by ID',
    'description' => 'Get invitation by ID.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_members',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembers',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/members',
    'summary' => 'Returns a paginated list of organization members filtered according to the specified parameters',
    'description' => 'Returns a paginated list of organization members filtered according to the specified parameters.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether the param \'search\' must match exactly or not',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The position of the first result to be processed (pagination offset)',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of results to be returned. Defaults to 10',
      ),
      'membership_type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The membership type',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String representing either a member\'s username, e-mail, first name, or last name.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
      'exact' => 'exact',
      'first' => 'first',
      'max' => 'max',
      'membershipType' => 'membership_type',
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members_count' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_members_count',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersCount',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/members/count',
    'summary' => 'Returns number of members in the organization',
    'description' => 'Returns number of members in the organization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/members/{member-id}',
    'summary' => 'Returns the member of the organization with the specified id',
    'description' => 'Searches for auser with the given id. If one is found, and is currently a member of the organization, returns it. Otherwise,an error response with status NOT_FOUND is returned',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'member_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `member-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'member-id' => 'member_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id_groups' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id_groups',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberIdGroups',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/members/{member-id}/groups',
    'summary' => 'Returns the organization group memberships for a member with the specified id',
    'description' => 'Searches for auser with the given id. If one is found, and is currently a member of the organization, returns the groups from the organizationwhere the user is member of. Otherwise, an error response with status NOT_FOUND is returned',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'member_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `member-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `briefRepresentation`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'member-id' => 'member_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id_organizations' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id_organizations',
    'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberIdOrganizations',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/members/{member-id}/organizations',
    'summary' => 'Returns the organizations associated with the user that has the specified id',
    'description' => 'Returns the organizations associated with the user that has the specified id.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'member_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `member-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return the full representation. Otherwise, only the basic fields are returned.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'member-id' => 'member_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles',
    'class' => 'KeycloakGetAdminRealmsRealmRoles',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles',
    'summary' => 'Get all roles for the realm or client',
    'description' => 'Get all roles for the realm or client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `briefRepresentation`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_by_id_role_id',
    'class' => 'KeycloakGetAdminRealmsRealmRolesByIdRoleId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}',
    'summary' => 'Get a specific role\'s representation',
    'description' => 'Get a specific role\'s representation.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of role',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites',
    'class' => 'KeycloakGetAdminRealmsRealmRolesByIdRoleIdComposites',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/composites',
    'summary' => 'Get role\'s children Returns a set of role\'s children provided the role is a composite',
    'description' => 'Get role\'s children Returns a set of role\'s children provided the role is a composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-id`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
      'first' => 'first',
      'max' => 'max',
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites_clients_client_uuid' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites_clients_client_uuid',
    'class' => 'KeycloakGetAdminRealmsRealmRolesByIdRoleIdCompositesClientsClientUuid',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/composites/clients/{clientUuid}',
    'summary' => 'Get client-level roles for the client that are in the role\'s composite',
    'description' => 'Get client-level roles for the client that are in the role\'s composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientUuid`.',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'clientUuid' => 'client_uuid',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites_realm' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites_realm',
    'class' => 'KeycloakGetAdminRealmsRealmRolesByIdRoleIdCompositesRealm',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/composites/realm',
    'summary' => 'Get realm-level roles that are in the role\'s composite',
    'description' => 'Get realm-level roles that are in the role\'s composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_by_id_role_id_management_permissions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_by_id_role_id_management_permissions',
    'class' => 'KeycloakGetAdminRealmsRealmRolesByIdRoleIdManagementPermissions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/management/permissions',
    'summary' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_role_name',
    'class' => 'KeycloakGetAdminRealmsRealmRolesRoleName',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles/{role-name}',
    'summary' => 'Get a role by name',
    'description' => 'Get a role by name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_composites' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_composites',
    'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameComposites',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles/{role-name}/composites',
    'summary' => 'Get composites of the role',
    'description' => 'Get composites of the role.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_composites_clients_target_client_uuid' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_composites_clients_target_client_uuid',
    'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameCompositesClientsTargetClientUuid',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles/{role-name}/composites/clients/{targetClientUuid}',
    'summary' => 'Get client-level roles for the client that are in the role\'s composite',
    'description' => 'Get client-level roles for the client that are in the role\'s composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
      'target_client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `targetClientUuid`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
      'targetClientUuid' => 'target_client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_composites_realm' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_composites_realm',
    'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameCompositesRealm',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles/{role-name}/composites/realm',
    'summary' => 'Get realm-level roles of the role\'s composite',
    'description' => 'Get realm-level roles of the role\'s composite.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_groups' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_groups',
    'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameGroups',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles/{role-name}/groups',
    'summary' => 'Returns a stream of groups that have the specified role name',
    'description' => 'Returns a stream of groups that have the specified role name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'the role name.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return a full representation of the {@code GroupRepresentation} objects.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'first result to return. Ignored if negative or {@code null}.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'maximum number of results to return. Ignored if negative or {@code null}.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_management_permissions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_management_permissions',
    'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameManagementPermissions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles/{role-name}/management/permissions',
    'summary' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-name`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_roles_role_name_users' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_users',
    'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameUsers',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/roles/{role-name}/users',
    'summary' => 'Returns a stream of users that have the specified role name',
    'description' => 'Returns a stream of users that have the specified role name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'the role name.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether brief representations are returned (default: false)',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'first result to return. Ignored if negative or {@code null}.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'maximum number of results to return. Ignored if negative or {@code null}.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users',
    'class' => 'KeycloakGetAdminRealmsRealmUsers',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users',
    'summary' => 'Get users Returns a stream of users, filtered according to query parameters',
    'description' => 'Returns a stream of users. Note that the \'credentials\' field in the returned UserRepresentation objects is typically not populated for performance reasons. If specific credential metadata is required, use the dedicated \'GET /admin/realms/{realm}/users/{user-id}/credentials\' endpoint.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether brief representations are returned (default: false)',
      ),
      'created_after' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Only return users created after (inclusive) the given date, in ISO-8601 format (yyyy-MM-dd) or epoch milliseconds',
      ),
      'created_before' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Only return users created before (inclusive) the given date, in ISO-8601 format (yyyy-MM-dd) or epoch milliseconds',
      ),
      'email' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in email, or the complete email, if param "exact" is true',
      ),
      'email_verified' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'whether the email has been verified',
      ),
      'enabled' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean representing if user is enabled or not',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether the params "last", "first", "email" and "username" must match exactly',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination offset',
      ),
      'first_name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in firstName, or the complete firstName, if param "exact" is true',
      ),
      'idp_alias' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The alias of an Identity Provider linked to the user',
      ),
      'idp_user_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId at an Identity Provider linked to the user',
      ),
      'last_name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in lastName, or the complete lastName, if param "exact" is true',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum results size (defaults to 100)',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A query to search for custom attributes, in the format \'key1:value2 key2:value2\'',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in username, first or last name, or email. Default search behavior is prefix-based (e.g., foo or foo*). Use *foo* for infix search and "foo" for exact search.',
      ),
      'username' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in username, or the complete username, if param "exact" is true',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'createdAfter' => 'created_after',
      'createdBefore' => 'created_before',
      'email' => 'email',
      'emailVerified' => 'email_verified',
      'enabled' => 'enabled',
      'exact' => 'exact',
      'first' => 'first',
      'firstName' => 'first_name',
      'idpAlias' => 'idp_alias',
      'idpUserId' => 'idp_user_id',
      'lastName' => 'last_name',
      'max' => 'max',
      'q' => 'q',
      'search' => 'search',
      'username' => 'username',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_count' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_count',
    'class' => 'KeycloakGetAdminRealmsRealmUsersCount',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/count',
    'summary' => 'Returns the number of users that match the given criteria',
    'description' => 'It can be called in three different ways. 1. Don’t specify any criteria and pass {@code null}. The number of all users within that realm will be returned. 2. If {@code search} is specified other criteria such as {@code last} will be ignored even though you set them. The {@code search} string will be matched against the first and last name, the username and the email of a user. 3. If {@code search} is unspecified but any of {@code last}, {@code first}, {@code email} or {@code username} those crit',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'created_after' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Only return users created after (inclusive) the given date, in ISO-8601 format (yyyy-MM-dd) or epoch milliseconds',
      ),
      'created_before' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Only return users created before (inclusive) the given date, in ISO-8601 format (yyyy-MM-dd) or epoch milliseconds',
      ),
      'email' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in email, or the complete email, if param "exact" is true',
      ),
      'email_verified' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'whether the email has been verified',
      ),
      'enabled' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean representing if user is enabled or not',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether the params "last", "first", "email" and "username" must match exactly',
      ),
      'first_name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in firstName, or the complete firstName, if param "exact" is true',
      ),
      'idp_alias' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The alias of an Identity Provider linked to the user',
      ),
      'idp_user_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId at an Identity Provider linked to the user',
      ),
      'last_name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in lastName, or the complete lastName, if param "exact" is true',
      ),
      'q' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A query to search for custom attributes, in the format \'key1:value2 key2:value2\'',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in username, first or last name, or email. Default search behavior is prefix-based (e.g., foo or foo*). Use *foo* for infix search and "foo" for exact search.',
      ),
      'username' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String contained in username, or the complete username, if param "exact" is true',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'createdAfter' => 'created_after',
      'createdBefore' => 'created_before',
      'email' => 'email',
      'emailVerified' => 'email_verified',
      'enabled' => 'enabled',
      'exact' => 'exact',
      'firstName' => 'first_name',
      'idpAlias' => 'idp_alias',
      'idpUserId' => 'idp_user_id',
      'lastName' => 'last_name',
      'q' => 'q',
      'search' => 'search',
      'username' => 'username',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_management_permissions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_management_permissions',
    'class' => 'KeycloakGetAdminRealmsRealmUsersManagementPermissions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users-management-permissions',
    'summary' => 'GET /admin/realms/{realm}/users-management-permissions',
    'description' => 'GET /admin/realms/{realm}/users-management-permissions.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_profile' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_profile',
    'class' => 'KeycloakGetAdminRealmsRealmUsersProfile',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/profile',
    'summary' => 'GET /admin/realms/{realm}/users/profile',
    'description' => 'Get the configuration for the user profile',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_profile_metadata' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_profile_metadata',
    'class' => 'KeycloakGetAdminRealmsRealmUsersProfileMetadata',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/profile/metadata',
    'summary' => 'GET /admin/realms/{realm}/users/profile/metadata',
    'description' => 'Get the UserProfileMetadata from the configuration',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}',
    'summary' => 'Get representation of the user',
    'description' => 'Get representation of the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'user_profile_metadata' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Indicates if the user profile metadata should be added to the response',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
      'userProfileMetadata' => 'user_profile_metadata',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_configured_user_storage_credential_types' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_configured_user_storage_credential_types',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdConfiguredUserStorageCredentialTypes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/configured-user-storage-credential-types',
    'summary' => 'Return credential types, which are provided by the user storage where user is stored',
    'description' => 'Returned values can contain for example "password", "otp" etc. This will always return empty list for "local" users, which are not backed by any user storage',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_consents' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_consents',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdConsents',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/consents',
    'summary' => 'Get consents granted by the user',
    'description' => 'Get consents granted by the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_credentials' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_credentials',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdCredentials',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/credentials',
    'summary' => 'GET /admin/realms/{realm}/users/{user-id}/credentials',
    'description' => 'GET /admin/realms/{realm}/users/{user-id}/credentials.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_federated_identity' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_federated_identity',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdFederatedIdentity',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/federated-identity',
    'summary' => 'Get social logins associated with the user',
    'description' => 'Get social logins associated with the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_groups' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_groups',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdGroups',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/groups',
    'summary' => 'GET /admin/realms/{realm}/users/{user-id}/groups',
    'description' => 'GET /admin/realms/{realm}/users/{user-id}/groups.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `briefRepresentation`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
      'first' => 'first',
      'max' => 'max',
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_groups_count' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_groups_count',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdGroupsCount',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/groups/count',
    'summary' => 'GET /admin/realms/{realm}/users/{user-id}/groups/count',
    'description' => 'GET /admin/realms/{realm}/users/{user-id}/groups/count.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `search`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_offline_sessions_client_uuid' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_offline_sessions_client_uuid',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdOfflineSessionsClientUuid',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/offline-sessions/{clientUuid}',
    'summary' => 'Get offline sessions associated with the user and client',
    'description' => 'Get offline sessions associated with the user and client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientUuid`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'clientUuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappings',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings',
    'summary' => 'Get role mappings',
    'description' => 'Get role mappings.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id}',
    'summary' => 'Get client-level role mappings for the user or group, and the app',
    'description' => 'Get client-level role mappings for the user or group, and the app.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id_available',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsClientsClientIdAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id}/available',
    'summary' => 'Get available client-level roles that can be mapped to the user or group',
    'description' => 'Get available client-level roles that can be mapped to the user or group.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id_composite',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsClientsClientIdComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id}/composite',
    'summary' => 'Get effective client-level role mappings This recurses any composite roles',
    'description' => 'Get effective client-level role mappings This recurses any composite roles.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealm',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/realm',
    'summary' => 'Get realm-level role mappings',
    'description' => 'Get realm-level role mappings.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm_available' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm_available',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealmAvailable',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/realm/available',
    'summary' => 'Get realm-level roles that can be mapped',
    'description' => 'Get realm-level roles that can be mapped.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm_composite' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm_composite',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealmComposite',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/realm/composite',
    'summary' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result',
    'description' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'brief_representation' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'if false, return roles with their attributes',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
      'briefRepresentation' => 'brief_representation',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_sessions' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_sessions',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdSessions',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/sessions',
    'summary' => 'Get sessions associated with the user',
    'description' => 'Get sessions associated with the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_users_user_id_unmanaged_attributes' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_users_user_id_unmanaged_attributes',
    'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdUnmanagedAttributes',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/users/{user-id}/unmanagedAttributes',
    'summary' => 'GET /admin/realms/{realm}/users/{user-id}/unmanagedAttributes',
    'description' => 'GET /admin/realms/{realm}/users/{user-id}/unmanagedAttributes.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_workflows' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_workflows',
    'class' => 'KeycloakGetAdminRealmsRealmWorkflows',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/workflows',
    'summary' => 'List workflows',
    'description' => 'List workflows filtered by name and paginated using first and max parameters.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'exact' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Boolean which defines whether the param \'search\' must match exactly or not',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The position of the first result to be processed (pagination offset)',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of results to be returned - defaults to 10',
      ),
      'search' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String representing the workflow name - either partial or exact',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'exact' => 'exact',
      'first' => 'first',
      'max' => 'max',
      'search' => 'search',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_workflows_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_workflows_id',
    'class' => 'KeycloakGetAdminRealmsRealmWorkflowsId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/workflows/{id}',
    'summary' => 'Get workflow',
    'description' => 'Get the workflow representation. Optionally exclude the workflow id from the response.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow identifier',
      ),
      'include_id' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Indicates whether the workflow and step ids should be included in the representation or not - defaults to true',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
      'includeId' => 'include_id',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_get_admin_realms_realm_workflows_scheduled_resource_id' =>
  array (
    'slug' => 'keycloak_get_admin_realms_realm_workflows_scheduled_resource_id',
    'class' => 'KeycloakGetAdminRealmsRealmWorkflowsScheduledResourceId',
    'method' => 'GET',
    'path' => '/admin/realms/{realm}/workflows/scheduled/{resource-id}',
    'summary' => 'List scheduled workflows for resource',
    'description' => 'Return workflows that have scheduled steps for the given resource identifier.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Identifier of the resource associated with the scheduled workflows',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'resource-id' => 'resource_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'read',
  ),
  'keycloak_post_admin_realms' =>
  array (
    'slug' => 'keycloak_post_admin_realms',
    'class' => 'KeycloakPostAdminRealms',
    'method' => 'POST',
    'path' => '/admin/realms',
    'summary' => 'Import a realm. Imports a realm from a full representation of that realm',
    'description' => 'Realm name must be unique.',
    'parameters' =>
    array (
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_config' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_config',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationConfig',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/config',
    'summary' => 'Create new authenticator configuration',
    'description' => 'Create new authenticator configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_executions' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_executions',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationExecutions',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/executions',
    'summary' => 'Add new authentication execution',
    'description' => 'Add new authentication execution.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_executions_execution_id_config' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_executions_execution_id_config',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationExecutionsExecutionIdConfig',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/executions/{executionId}/config',
    'summary' => 'Update execution with new configuration',
    'description' => 'Update execution with new configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'execution_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Execution id',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'executionId' => 'execution_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_executions_execution_id_lower_priority' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_executions_execution_id_lower_priority',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationExecutionsExecutionIdLowerPriority',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/executions/{executionId}/lower-priority',
    'summary' => 'Lower execution\'s priority',
    'description' => 'Lower execution\'s priority.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'execution_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Execution id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'executionId' => 'execution_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_executions_execution_id_raise_priority' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_executions_execution_id_raise_priority',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationExecutionsExecutionIdRaisePriority',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/executions/{executionId}/raise-priority',
    'summary' => 'Raise execution\'s priority',
    'description' => 'Raise execution\'s priority.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'execution_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Execution id',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'executionId' => 'execution_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_flows' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_flows',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationFlows',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/flows',
    'summary' => 'Create a new authentication flow',
    'description' => 'Create a new authentication flow.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_copy' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_copy',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasCopy',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/flows/{flowAlias}/copy',
    'summary' => 'Copy existing authentication flow under a new name The new name is given as \'newName\' attribute of the passed JSON object',
    'description' => 'Copy existing authentication flow under a new name The new name is given as \'newName\' attribute of the passed JSON object.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'flow_alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'name of the existing authentication flow',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'flowAlias' => 'flow_alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_executions_execution' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_executions_execution',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasExecutionsExecution',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/flows/{flowAlias}/executions/execution',
    'summary' => 'Add new authentication execution to a flow',
    'description' => 'Add new authentication execution to a flow.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'flow_alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of parent flow',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'flowAlias' => 'flow_alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_executions_flow' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_executions_flow',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasExecutionsFlow',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/flows/{flowAlias}/executions/flow',
    'summary' => 'Add new flow with new execution to existing flow',
    'description' => 'Add new flow with new execution to existing flow.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'flow_alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of parent authentication flow',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'flowAlias' => 'flow_alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_register_required_action' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_register_required_action',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationRegisterRequiredAction',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/register-required-action',
    'summary' => 'Register a new required actions',
    'description' => 'Register a new required actions.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_required_actions_alias_lower_priority' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_required_actions_alias_lower_priority',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationRequiredActionsAliasLowerPriority',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/lower-priority',
    'summary' => 'Lower required action\'s priority',
    'description' => 'Lower required action\'s priority.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of required action',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_authentication_required_actions_alias_raise_priority' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_authentication_required_actions_alias_raise_priority',
    'class' => 'KeycloakPostAdminRealmsRealmAuthenticationRequiredActionsAliasRaisePriority',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/raise-priority',
    'summary' => 'Raise required action\'s priority',
    'description' => 'Raise required action\'s priority.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of required action',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_description_converter' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_description_converter',
    'class' => 'KeycloakPostAdminRealmsRealmClientDescriptionConverter',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-description-converter',
    'summary' => 'Base path for importing clients under this realm',
    'description' => 'Base path for importing clients under this realm.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_scopes' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_scopes',
    'class' => 'KeycloakPostAdminRealmsRealmClientScopes',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-scopes',
    'summary' => 'Create a new client scope Client Scope’s name must be unique!',
    'description' => 'Create a new client scope Client Scope’s name must be unique!.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_add_models' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_add_models',
    'class' => 'KeycloakPostAdminRealmsRealmClientScopesClientScopeIdProtocolMappersAddModels',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/add-models',
    'summary' => 'Create multiple mappers',
    'description' => 'Create multiple mappers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models',
    'class' => 'KeycloakPostAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModels',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/models',
    'summary' => 'Create a mapper',
    'description' => 'Create a mapper.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client',
    'class' => 'KeycloakPostAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClient',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/clients/{client}',
    'summary' => 'Add client-level roles to the client\'s scope',
    'description' => 'Add client-level roles to the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm',
    'class' => 'KeycloakPostAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealm',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/realm',
    'summary' => 'Add a set of realm-level roles to the client\'s scope',
    'description' => 'Add a set of realm-level roles to the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_templates' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_templates',
    'class' => 'KeycloakPostAdminRealmsRealmClientTemplates',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-templates',
    'summary' => 'Create a new client scope Client Scope’s name must be unique!',
    'description' => 'Create a new client scope Client Scope’s name must be unique!.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_add_models' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_add_models',
    'class' => 'KeycloakPostAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersAddModels',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/protocol-mappers/add-models',
    'summary' => 'Create multiple mappers',
    'description' => 'Create multiple mappers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models',
    'class' => 'KeycloakPostAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModels',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/protocol-mappers/models',
    'summary' => 'Create a mapper',
    'description' => 'Create a mapper.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client',
    'class' => 'KeycloakPostAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClient',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/clients/{client}',
    'summary' => 'Add client-level roles to the client\'s scope',
    'description' => 'Add client-level roles to the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_client_templates_client_scope_id_scope_mappings_realm',
    'class' => 'KeycloakPostAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsRealm',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/realm',
    'summary' => 'Add a set of realm-level roles to the client\'s scope',
    'description' => 'Add a set of realm-level roles to the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients',
    'class' => 'KeycloakPostAdminRealmsRealmClients',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients',
    'summary' => 'Create a new client Client’s client_id must be unique!',
    'description' => 'Create a new client Client’s client_id must be unique!.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_import' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_import',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerImport',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import',
    'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_permission' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_permission',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPermission',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission',
    'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_evaluate' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_evaluate',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionEvaluate',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/evaluate',
    'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/evaluate',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/evaluate.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_policy' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_policy',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicy',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
    'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_policy_evaluate' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_policy_evaluate',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicyEvaluate',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/evaluate',
    'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/evaluate',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy/evaluate.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_resource' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_resource',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerResource',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource',
    'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `_id`.',
      ),
      'deep' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `deep`.',
      ),
      'exact_name' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exactName`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'matching_uri' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `matchingUri`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
      'uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `uri`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
      '_id' => 'id',
      'deep' => 'deep',
      'exactName' => 'exact_name',
      'first' => 'first',
      'matchingUri' => 'matching_uri',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'scope' => 'scope',
      'type' => 'type',
      'uri' => 'uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_scope' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_scope',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerScope',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope',
    'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope',
    'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_download' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_download',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrDownload',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/download',
    'summary' => 'Get a keystore file for the client, containing private key and public certificate',
    'description' => 'Get a keystore file for the client, containing private key and public certificate.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'attr' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `attr`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'attr' => 'attr',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_generate' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_generate',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrGenerate',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/generate',
    'summary' => 'Generate a new certificate with new key pair',
    'description' => 'Generate a new certificate with new key pair.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'attr' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `attr`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'attr' => 'attr',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_generate_and_download' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_generate_and_download',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrGenerateAndDownload',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/generate-and-download',
    'summary' => 'Generate a new keypair and certificate, and get the private key file Generates a keypair and certificate and serves the private key in a specified keystore format. Only generated public certificate is saved in Keycloak DB - the private key is not',
    'description' => 'Generate a new keypair and certificate, and get the private key file Generates a keypair and certificate and serves the private key in a specified keystore format. Only generated public certificate is saved in Keycloak DB - the private key is not.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'attr' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `attr`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'attr' => 'attr',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_upload' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_upload',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrUpload',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/upload',
    'summary' => 'Upload certificate and eventually private key',
    'description' => 'Upload certificate and eventually private key.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'attr' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `attr`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'attr' => 'attr',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_upload_certificate' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_certificates_attr_upload_certificate',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidCertificatesAttrUploadCertificate',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/certificates/{attr}/upload-certificate',
    'summary' => 'Upload only certificate, not private key',
    'description' => 'Upload only certificate, not private key.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'attr' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `attr`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'attr' => 'attr',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_client_secret' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_client_secret',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidClientSecret',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/client-secret',
    'summary' => 'Generate a new secret for the client',
    'description' => 'Generate a new secret for the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_nodes' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_nodes',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidNodes',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/nodes',
    'summary' => 'Register a cluster node with the client Manually register cluster node to this client - usually it’s not needed to call this directly as adapter should handle by sending registration request to Keycloak',
    'description' => 'Register a cluster node with the client Manually register cluster node to this client - usually it’s not needed to call this directly as adapter should handle by sending registration request to Keycloak.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_protocol_mappers_add_models' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_protocol_mappers_add_models',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidProtocolMappersAddModels',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/add-models',
    'summary' => 'Create multiple mappers',
    'description' => 'Create multiple mappers.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_protocol_mappers_models' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_protocol_mappers_models',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidProtocolMappersModels',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/models',
    'summary' => 'Create a mapper',
    'description' => 'Create a mapper.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_push_revocation' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_push_revocation',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidPushRevocation',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/push-revocation',
    'summary' => 'Push the client\'s revocation policy to its admin URL If the client has an admin URL, push revocation policy to it',
    'description' => 'Push the client\'s revocation policy to its admin URL If the client has an admin URL, push revocation policy to it.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_registration_access_token' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_registration_access_token',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidRegistrationAccessToken',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/registration-access-token',
    'summary' => 'Generate a new registration access token for the client',
    'description' => 'Generate a new registration access token for the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_roles' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_roles',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidRoles',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles',
    'summary' => 'Create a new role for the realm or client',
    'description' => 'Create a new role for the realm or client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_roles_role_name_composites' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_roles_role_name_composites',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidRolesRoleNameComposites',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites',
    'summary' => 'Add a composite to the role',
    'description' => 'Add a composite to the role.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidScopeMappingsClientsClient',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}',
    'summary' => 'Add client-level roles to the client\'s scope',
    'description' => 'Add client-level roles to the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'client' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'client' => 'client',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_client_uuid_scope_mappings_realm' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_scope_mappings_realm',
    'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidScopeMappingsRealm',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm',
    'summary' => 'Add a set of realm-level roles to the client\'s scope',
    'description' => 'Add a set of realm-level roles to the client\'s scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_clients_initial_access' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_clients_initial_access',
    'class' => 'KeycloakPostAdminRealmsRealmClientsInitialAccess',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/clients-initial-access',
    'summary' => 'Create a new initial access token',
    'description' => 'Create a new initial access token.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_components' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_components',
    'class' => 'KeycloakPostAdminRealmsRealmComponents',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/components',
    'summary' => 'POST /admin/realms/{realm}/components',
    'description' => 'POST /admin/realms/{realm}/components.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_groups' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_groups',
    'class' => 'KeycloakPostAdminRealmsRealmGroups',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/groups',
    'summary' => 'create or add a top level realm groupSet or create child',
    'description' => 'This will update the group and set the parent if it exists. Create it and set the parent if the group doesn’t exist.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_groups_group_id_children' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_groups_group_id_children',
    'class' => 'KeycloakPostAdminRealmsRealmGroupsGroupIdChildren',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/groups/{group-id}/children',
    'summary' => 'Set or create child',
    'description' => 'This will just set the parent if it exists. Create it and set the parent if the group doesn’t exist.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_groups_group_id_role_mappings_clients_client_id' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_groups_group_id_role_mappings_clients_client_id',
    'class' => 'KeycloakPostAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id}',
    'summary' => 'Add client-level roles to the user or group role mapping',
    'description' => 'Add client-level roles to the user or group role mapping.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_groups_group_id_role_mappings_realm' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_groups_group_id_role_mappings_realm',
    'class' => 'KeycloakPostAdminRealmsRealmGroupsGroupIdRoleMappingsRealm',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/realm',
    'summary' => 'Add realm-level role mappings to the user',
    'description' => 'Add realm-level role mappings to the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_identity_provider_import_config' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_identity_provider_import_config',
    'class' => 'KeycloakPostAdminRealmsRealmIdentityProviderImportConfig',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/identity-provider/import-config',
    'summary' => 'Import identity provider from JSON body',
    'description' => 'Import identity provider from uploaded JSON file',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_identity_provider_instances' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_identity_provider_instances',
    'class' => 'KeycloakPostAdminRealmsRealmIdentityProviderInstances',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/identity-provider/instances',
    'summary' => 'Create a new identity provider',
    'description' => 'Create a new identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_identity_provider_instances_alias_mappers' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_identity_provider_instances_alias_mappers',
    'class' => 'KeycloakPostAdminRealmsRealmIdentityProviderInstancesAliasMappers',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers',
    'summary' => 'Add a mapper to identity provider',
    'description' => 'Add a mapper to identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_identity_provider_upload_certificate' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_identity_provider_upload_certificate',
    'class' => 'KeycloakPostAdminRealmsRealmIdentityProviderUploadCertificate',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/identity-provider/upload-certificate',
    'summary' => 'Uploads a certificate, prepares the jwks or public key associated, and returns the certificate representation',
    'description' => 'Uploads a certificate, prepares the jwks or public key associated, and returns the certificate representation.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_localization_locale' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_localization_locale',
    'class' => 'KeycloakPostAdminRealmsRealmLocalizationLocale',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/localization/{locale}',
    'summary' => 'Import localization from uploaded JSON file',
    'description' => 'Import localization from uploaded JSON file.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'locale' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `locale`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'locale' => 'locale',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_logout_all' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_logout_all',
    'class' => 'KeycloakPostAdminRealmsRealmLogoutAll',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/logout-all',
    'summary' => 'Removes all user sessions',
    'description' => 'Any client that has an admin url will also be told to invalidate any sessions they have.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_organizations' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_organizations',
    'class' => 'KeycloakPostAdminRealmsRealmOrganizations',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/organizations',
    'summary' => 'Creates a new organization',
    'description' => 'Creates a new organization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_groups' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_groups',
    'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdGroups',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups',
    'summary' => 'Creates a new top-level group or moves an existing group to top-level',
    'description' => 'Creates a new top-level group in the organization. If the group representation includes an ID, moves the existing organization group to be a top-level group. If no ID is provided, creates a new top-level group.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_groups_group_id_children' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_groups_group_id_children',
    'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdChildren',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/children',
    'summary' => 'Create or move a subgroup',
    'description' => 'Creates a new subgroup under this organization group. If the group representation includes an ID, moves the existing group to be a child of this group. If no ID is provided, creates a new subgroup.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_identity_providers' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_identity_providers',
    'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdIdentityProviders',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/identity-providers',
    'summary' => 'Adds the identity provider with the specified id to the organization',
    'description' => 'Adds, or associates, an existing identity provider with the organization. If no identity provider is found, or if it is already associated with the organization, an error response is returned',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_invitations_id_resend' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_invitations_id_resend',
    'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdInvitationsIdResend',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/invitations/{id}/resend',
    'summary' => 'Resend an invitation',
    'description' => 'Resend an invitation.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_members' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_members',
    'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembers',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/members',
    'summary' => 'Adds the user with the specified id as a member of the organization',
    'description' => 'Adds, or associates, an existing user with the organization. If no user is found, or if it is already associated with the organization, an error response is returned',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => true,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_members_invite_existing_user' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_members_invite_existing_user',
    'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembersInviteExistingUser',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/members/invite-existing-user',
    'summary' => 'Invites an existing user to the organization, using the specified user id',
    'description' => 'Invites an existing user to the organization, using the specified user id.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/x-www-form-urlencoded',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_organizations_org_id_members_invite_user' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_members_invite_user',
    'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembersInviteUser',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/members/invite-user',
    'summary' => 'Invites an existing user or sends a registration link to a new user, based on the provided e-mail address',
    'description' => 'If the user with the given e-mail address exists, it sends an invitation link, otherwise it sends a registration link.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/x-www-form-urlencoded',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_partial_export' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_partial_export',
    'class' => 'KeycloakPostAdminRealmsRealmPartialExport',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/partial-export',
    'summary' => 'Partial export of existing realm into a JSON file',
    'description' => 'Partial export of existing realm into a JSON file.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'export_clients' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exportClients`.',
      ),
      'export_groups_and_roles' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exportGroupsAndRoles`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'exportClients' => 'export_clients',
      'exportGroupsAndRoles' => 'export_groups_and_roles',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_partial_import' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_partial_import',
    'class' => 'KeycloakPostAdminRealmsRealmPartialImport',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/partialImport',
    'summary' => 'Partial import from a JSON file to an existing realm',
    'description' => 'Partial import from a JSON file to an existing realm.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_push_revocation' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_push_revocation',
    'class' => 'KeycloakPostAdminRealmsRealmPushRevocation',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/push-revocation',
    'summary' => 'Push the realm\'s revocation policy to any client that has an admin url associated with it',
    'description' => 'Push the realm\'s revocation policy to any client that has an admin url associated with it.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_roles' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_roles',
    'class' => 'KeycloakPostAdminRealmsRealmRoles',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/roles',
    'summary' => 'Create a new role for the realm or client',
    'description' => 'Create a new role for the realm or client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_roles_by_id_role_id_composites' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_roles_by_id_role_id_composites',
    'class' => 'KeycloakPostAdminRealmsRealmRolesByIdRoleIdComposites',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/composites',
    'summary' => 'Make the role a composite role by associating some child roles',
    'description' => 'Make the role a composite role by associating some child roles.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_roles_role_name_composites' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_roles_role_name_composites',
    'class' => 'KeycloakPostAdminRealmsRealmRolesRoleNameComposites',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/roles/{role-name}/composites',
    'summary' => 'Add a composite to the role',
    'description' => 'Add a composite to the role.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_test_smtpconnection' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_test_smtpconnection',
    'class' => 'KeycloakPostAdminRealmsRealmTestSmtpconnection',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/testSMTPConnection',
    'summary' => 'Test SMTP connection with current logged in user',
    'description' => 'Test SMTP connection with current logged in user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_users' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_users',
    'class' => 'KeycloakPostAdminRealmsRealmUsers',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/users',
    'summary' => 'Create a new user Username must be unique',
    'description' => 'Create a new user Username must be unique.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_credentials_credential_id_move_after_new_previous_credential_id' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_users_user_id_credentials_credential_id_move_after_new_previous_credential_id',
    'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdCredentialsCredentialIdMoveAfterNewPreviousCredentialId',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/users/{user-id}/credentials/{credentialId}/moveAfter/{newPreviousCredentialId}',
    'summary' => 'Move a credential to a position behind another credential',
    'description' => 'Move a credential to a position behind another credential.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'credential_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The credential to move',
      ),
      'new_previous_credential_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The credential that will be the previous element in the list. If set to null, the moved credential will be the first element in the list.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'credentialId' => 'credential_id',
      'newPreviousCredentialId' => 'new_previous_credential_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_credentials_credential_id_move_to_first' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_users_user_id_credentials_credential_id_move_to_first',
    'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdCredentialsCredentialIdMoveToFirst',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/users/{user-id}/credentials/{credentialId}/moveToFirst',
    'summary' => 'Move a credential to a first position in the credentials list of the user',
    'description' => 'Move a credential to a first position in the credentials list of the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'credential_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The credential to move',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'credentialId' => 'credential_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_federated_identity_provider' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_users_user_id_federated_identity_provider',
    'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdFederatedIdentityProvider',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/users/{user-id}/federated-identity/{provider}',
    'summary' => 'Add a social login provider to the user',
    'description' => 'Add a social login provider to the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'provider' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Social login provider id',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'provider' => 'provider',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_impersonation' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_users_user_id_impersonation',
    'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdImpersonation',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/users/{user-id}/impersonation',
    'summary' => 'Impersonate the user',
    'description' => 'Impersonate the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_logout' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_users_user_id_logout',
    'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdLogout',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/users/{user-id}/logout',
    'summary' => 'Remove all user sessions associated with the user Also send notification to all clients that have an admin URL to invalidate the sessions for the particular user',
    'description' => 'Remove all user sessions associated with the user Also send notification to all clients that have an admin URL to invalidate the sessions for the particular user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_role_mappings_clients_client_id' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_users_user_id_role_mappings_clients_client_id',
    'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id}',
    'summary' => 'Add client-level roles to the user or group role mapping',
    'description' => 'Add client-level roles to the user or group role mapping.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'client id (not clientId!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'client-id' => 'client_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_users_user_id_role_mappings_realm' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_users_user_id_role_mappings_realm',
    'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdRoleMappingsRealm',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/realm',
    'summary' => 'Add realm-level role mappings to the user',
    'description' => 'Add realm-level role mappings to the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_workflows' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_workflows',
    'class' => 'KeycloakPostAdminRealmsRealmWorkflows',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/workflows',
    'summary' => 'Create workflow',
    'description' => 'Create a new workflow from the provided representation.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/yaml',
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_workflows_id_activate_type_resource_id' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_workflows_id_activate_type_resource_id',
    'class' => 'KeycloakPostAdminRealmsRealmWorkflowsIdActivateTypeResourceId',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/workflows/{id}/activate/{type}/{resourceId}',
    'summary' => 'Activate workflow for resource',
    'description' => 'Activate the workflow for the given resource type and identifier. Optionally schedule the first step using the notBefore parameter.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow identifier',
      ),
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Resource identifier',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Resource type',
      ),
      'not_before' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Optional value representing the time to schedule the first workflow step. The value is either an integer representing the seconds from now, an integer followed by \'ms\' representing milliseconds from now, or an ISO-8601 date string.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
      'resourceId' => 'resource_id',
      'type' => 'type',
    ),
    'query_params' =>
    array (
      'notBefore' => 'not_before',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_workflows_id_deactivate_type_resource_id' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_workflows_id_deactivate_type_resource_id',
    'class' => 'KeycloakPostAdminRealmsRealmWorkflowsIdDeactivateTypeResourceId',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/workflows/{id}/deactivate/{type}/{resourceId}',
    'summary' => 'Deactivate workflow for resource',
    'description' => 'Deactivate the workflow for the given resource type and identifier.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow identifier',
      ),
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Resource identifier',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Resource type',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
      'resourceId' => 'resource_id',
      'type' => 'type',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_post_admin_realms_realm_workflows_migrate' =>
  array (
    'slug' => 'keycloak_post_admin_realms_realm_workflows_migrate',
    'class' => 'KeycloakPostAdminRealmsRealmWorkflowsMigrate',
    'method' => 'POST',
    'path' => '/admin/realms/{realm}/workflows/migrate',
    'summary' => 'Migrate scheduled resources from one step to another',
    'description' => 'Migrate scheduled resources from one step to another step in the same or in a different workflow.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'from' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String representing the id of the step to migrate from',
      ),
      'to' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A String representing the id of the step to migrate to',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
      'from' => 'from',
      'to' => 'to',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm',
    'class' => 'KeycloakPutAdminRealmsRealm',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}',
    'summary' => 'Update the top-level information of the realm Any user, roles or client information in the representation will be ignored',
    'description' => 'This will only update top-level attributes of the realm.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_authentication_config_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_authentication_config_id',
    'class' => 'KeycloakPutAdminRealmsRealmAuthenticationConfigId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/authentication/config/{id}',
    'summary' => 'Update authenticator configuration',
    'description' => 'Update authenticator configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Configuration id',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_authentication_flows_flow_alias_executions' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_authentication_flows_flow_alias_executions',
    'class' => 'KeycloakPutAdminRealmsRealmAuthenticationFlowsFlowAliasExecutions',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/authentication/flows/{flowAlias}/executions',
    'summary' => 'Update authentication executions of a Flow',
    'description' => 'Update authentication executions of a Flow.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'flow_alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Flow alias',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'flowAlias' => 'flow_alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_authentication_flows_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_authentication_flows_id',
    'class' => 'KeycloakPutAdminRealmsRealmAuthenticationFlowsId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/authentication/flows/{id}',
    'summary' => 'Update an authentication flow',
    'description' => 'Update an authentication flow.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_authentication_required_actions_alias' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_authentication_required_actions_alias',
    'class' => 'KeycloakPutAdminRealmsRealmAuthenticationRequiredActionsAlias',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}',
    'summary' => 'Update required action',
    'description' => 'Update required action.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of required action',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_authentication_required_actions_alias_config' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_authentication_required_actions_alias_config',
    'class' => 'KeycloakPutAdminRealmsRealmAuthenticationRequiredActionsAliasConfig',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/config',
    'summary' => 'Update RequiredAction configuration',
    'description' => 'Update RequiredAction configuration.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Alias of required action',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_client_policies_policies' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_client_policies_policies',
    'class' => 'KeycloakPutAdminRealmsRealmClientPoliciesPolicies',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/client-policies/policies',
    'summary' => 'PUT /admin/realms/{realm}/client-policies/policies',
    'description' => 'PUT /admin/realms/{realm}/client-policies/policies.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_client_policies_profiles' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_client_policies_profiles',
    'class' => 'KeycloakPutAdminRealmsRealmClientPoliciesProfiles',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/client-policies/profiles',
    'summary' => 'PUT /admin/realms/{realm}/client-policies/profiles',
    'description' => 'PUT /admin/realms/{realm}/client-policies/profiles.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_client_scopes_client_scope_id',
    'class' => 'KeycloakPutAdminRealmsRealmClientScopesClientScopeId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}',
    'summary' => 'Update the client scope',
    'description' => 'Update the client scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id',
    'class' => 'KeycloakPutAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModelsId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/models/{id}',
    'summary' => 'Update the mapper',
    'description' => 'Update the mapper.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_client_templates_client_scope_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_client_templates_client_scope_id',
    'class' => 'KeycloakPutAdminRealmsRealmClientTemplatesClientScopeId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}',
    'summary' => 'Update the client scope',
    'description' => 'Update the client scope.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id',
    'class' => 'KeycloakPutAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModelsId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/protocol-mappers/models/{id}',
    'summary' => 'Update the mapper',
    'description' => 'Update the mapper.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `client-scope-id`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-scope-id' => 'client_scope_id',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_client_types' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_client_types',
    'class' => 'KeycloakPutAdminRealmsRealmClientTypes',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/client-types',
    'summary' => 'Update a client type',
    'description' => 'This endpoint allows you to update a realm level client type',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuid',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}',
    'summary' => 'Update the client',
    'description' => 'Update the client.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServer',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server',
    'summary' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
    'summary' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `_id`.',
      ),
      'deep' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `deep`.',
      ),
      'exact_name' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `exactName`.',
      ),
      'first' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `first`.',
      ),
      'matching_uri' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Official Keycloak query parameter `matchingUri`.',
      ),
      'max' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Official Keycloak query parameter `max`.',
      ),
      'name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `name`.',
      ),
      'owner' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `owner`.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `scope`.',
      ),
      'type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `type`.',
      ),
      'uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Official Keycloak query parameter `uri`.',
      ),
      'resource_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `resource-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'resource-id' => 'resource_id',
    ),
    'query_params' =>
    array (
      '_id' => 'id',
      'deep' => 'deep',
      'exactName' => 'exact_name',
      'first' => 'first',
      'matchingUri' => 'matching_uri',
      'max' => 'max',
      'name' => 'name',
      'owner' => 'owner',
      'scope' => 'scope',
      'type' => 'type',
      'uri' => 'uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
    'summary' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `scope-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'scope-id' => 'scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_default_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_default_client_scopes_client_scope_id',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidDefaultClientScopesClientScopeId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}',
    'summary' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/default-client-scopes/{clientScopeId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientScopeId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'clientScopeId' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_management_permissions' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_management_permissions',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidManagementPermissions',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/management/permissions',
    'summary' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_optional_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_optional_client_scopes_client_scope_id',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidOptionalClientScopesClientScopeId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}',
    'summary' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}',
    'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientScopeId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'clientScopeId' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidProtocolMappersModelsId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/models/{id}',
    'summary' => 'Update the mapper',
    'description' => 'Update the mapper.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_roles_role_name' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_roles_role_name',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidRolesRoleName',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}',
    'summary' => 'Update a role by name',
    'description' => 'Update a role by name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_clients_client_uuid_roles_role_name_management_permissions' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_roles_role_name_management_permissions',
    'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidRolesRoleNameManagementPermissions',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/management/permissions',
    'summary' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_uuid' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of client (not client-id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-name`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'client-uuid' => 'client_uuid',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_components_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_components_id',
    'class' => 'KeycloakPutAdminRealmsRealmComponentsId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/components/{id}',
    'summary' => 'PUT /admin/realms/{realm}/components/{id}',
    'description' => 'PUT /admin/realms/{realm}/components/{id}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_default_default_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_default_default_client_scopes_client_scope_id',
    'class' => 'KeycloakPutAdminRealmsRealmDefaultDefaultClientScopesClientScopeId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
    'summary' => 'PUT /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
    'description' => 'PUT /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientScopeId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'clientScopeId' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_default_groups_group_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_default_groups_group_id',
    'class' => 'KeycloakPutAdminRealmsRealmDefaultGroupsGroupId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/default-groups/{groupId}',
    'summary' => 'PUT /admin/realms/{realm}/default-groups/{groupId}',
    'description' => 'PUT /admin/realms/{realm}/default-groups/{groupId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `groupId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'groupId' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_default_optional_client_scopes_client_scope_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_default_optional_client_scopes_client_scope_id',
    'class' => 'KeycloakPutAdminRealmsRealmDefaultOptionalClientScopesClientScopeId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}',
    'summary' => 'PUT /admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}',
    'description' => 'PUT /admin/realms/{realm}/default-optional-client-scopes/{clientScopeId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'client_scope_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `clientScopeId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'clientScopeId' => 'client_scope_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_events_config' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_events_config',
    'class' => 'KeycloakPutAdminRealmsRealmEventsConfig',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/events/config',
    'summary' => 'PUT /admin/realms/{realm}/events/config',
    'description' => 'Update the events provider Change the events provider and/or its configuration',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_groups_group_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_groups_group_id',
    'class' => 'KeycloakPutAdminRealmsRealmGroupsGroupId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/groups/{group-id}',
    'summary' => 'Update group, ignores subgroups',
    'description' => 'Update group, ignores subgroups.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_groups_group_id_management_permissions' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_groups_group_id_management_permissions',
    'class' => 'KeycloakPutAdminRealmsRealmGroupsGroupIdManagementPermissions',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/groups/{group-id}/management/permissions',
    'summary' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_identity_provider_instances_alias' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_identity_provider_instances_alias',
    'class' => 'KeycloakPutAdminRealmsRealmIdentityProviderInstancesAlias',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}',
    'summary' => 'Update the identity provider',
    'description' => 'Update the identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_identity_provider_instances_alias_management_permissions' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_identity_provider_instances_alias_management_permissions',
    'class' => 'KeycloakPutAdminRealmsRealmIdentityProviderInstancesAliasManagementPermissions',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/management/permissions',
    'summary' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_identity_provider_instances_alias_mappers_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_identity_provider_instances_alias_mappers_id',
    'class' => 'KeycloakPutAdminRealmsRealmIdentityProviderInstancesAliasMappersId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers/{id}',
    'summary' => 'Update a mapper for the identity provider',
    'description' => 'Update a mapper for the identity provider.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'alias' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `alias`.',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Mapper id',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'alias' => 'alias',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_localization_locale_key' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_localization_locale_key',
    'class' => 'KeycloakPutAdminRealmsRealmLocalizationLocaleKey',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/localization/{locale}/{key}',
    'summary' => 'PUT /admin/realms/{realm}/localization/{locale}/{key}',
    'description' => 'PUT /admin/realms/{realm}/localization/{locale}/{key}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'key' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `key`.',
      ),
      'locale' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `locale`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'key' => 'key',
      'locale' => 'locale',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'text/plain',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_organizations_org_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_organizations_org_id',
    'class' => 'KeycloakPutAdminRealmsRealmOrganizationsOrgId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/organizations/{org-id}',
    'summary' => 'Updates the organization',
    'description' => 'Updates the organization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_organizations_org_id_groups_group_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_organizations_org_id_groups_group_id',
    'class' => 'KeycloakPutAdminRealmsRealmOrganizationsOrgIdGroupsGroupId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}',
    'summary' => 'Update organization group',
    'description' => 'Updates the organization group\'s name, description, and attributes. Subgroups are not affected.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'group-id' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_organizations_org_id_groups_group_id_members_user_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_organizations_org_id_groups_group_id_members_user_id',
    'class' => 'KeycloakPutAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembersUserId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/members/{userId}',
    'summary' => 'Add a user to this organization group',
    'description' => 'Adds an organization member to this group. The user must be a member of the organization.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'org_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `org-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `group-id`.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `userId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'org-id' => 'org_id',
      'group-id' => 'group_id',
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_roles_by_id_role_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_roles_by_id_role_id',
    'class' => 'KeycloakPutAdminRealmsRealmRolesByIdRoleId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}',
    'summary' => 'Update the role',
    'description' => 'Update the role.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'id of role',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_roles_by_id_role_id_management_permissions' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_roles_by_id_role_id_management_permissions',
    'class' => 'KeycloakPutAdminRealmsRealmRolesByIdRoleIdManagementPermissions',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/management/permissions',
    'summary' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-id' => 'role_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_roles_role_name' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_roles_role_name',
    'class' => 'KeycloakPutAdminRealmsRealmRolesRoleName',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/roles/{role-name}',
    'summary' => 'Update a role by name',
    'description' => 'Update a role by name.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'role\'s name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_roles_role_name_management_permissions' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_roles_role_name_management_permissions',
    'class' => 'KeycloakPutAdminRealmsRealmRolesRoleNameManagementPermissions',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/roles/{role-name}/management/permissions',
    'summary' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
    'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'role_name' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `role-name`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'role-name' => 'role_name',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_management_permissions' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_management_permissions',
    'class' => 'KeycloakPutAdminRealmsRealmUsersManagementPermissions',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users-management-permissions',
    'summary' => 'PUT /admin/realms/{realm}/users-management-permissions',
    'description' => 'PUT /admin/realms/{realm}/users-management-permissions.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_profile' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_profile',
    'class' => 'KeycloakPutAdminRealmsRealmUsersProfile',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users/profile',
    'summary' => 'PUT /admin/realms/{realm}/users/profile',
    'description' => 'Set the configuration for the user profile',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_user_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_user_id',
    'class' => 'KeycloakPutAdminRealmsRealmUsersUserId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users/{user-id}',
    'summary' => 'Update the user',
    'description' => 'Update the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_credentials_credential_id_user_label' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_user_id_credentials_credential_id_user_label',
    'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdCredentialsCredentialIdUserLabel',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users/{user-id}/credentials/{credentialId}/userLabel',
    'summary' => 'Update a credential label for a user',
    'description' => 'Update a credential label for a user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'credential_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `credentialId`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'credentialId' => 'credential_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'text/plain',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_disable_credential_types' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_user_id_disable_credential_types',
    'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdDisableCredentialTypes',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users/{user-id}/disable-credential-types',
    'summary' => 'Disable all credentials for a user of a specific type',
    'description' => 'Disable all credentials for a user of a specific type.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_execute_actions_email' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_user_id_execute_actions_email',
    'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdExecuteActionsEmail',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users/{user-id}/execute-actions-email',
    'summary' => 'Send an email to the user with a link they can click to execute particular actions',
    'description' => 'An email contains a link the user can click to perform a set of required actions. The redirectUri and clientId parameters are optional. If no redirect is given, then there will be no link back to click after actions have completed. Redirect uri must be a valid uri for the particular clientId.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Client id',
      ),
      'lifespan' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of seconds after which the generated token expires',
      ),
      'redirect_uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Redirect uri',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
      'client_id' => 'client_id',
      'lifespan' => 'lifespan',
      'redirect_uri' => 'redirect_uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_groups_group_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_user_id_groups_group_id',
    'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdGroupsGroupId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users/{user-id}/groups/{groupId}',
    'summary' => 'PUT /admin/realms/{realm}/users/{user-id}/groups/{groupId}',
    'description' => 'PUT /admin/realms/{realm}/users/{user-id}/groups/{groupId}.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `groupId`.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
      'groupId' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_reset_password' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_user_id_reset_password',
    'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdResetPassword',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users/{user-id}/reset-password',
    'summary' => 'Set up a new password for the user',
    'description' => 'Set up a new password for the user.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/json',
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_reset_password_email' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_user_id_reset_password_email',
    'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdResetPasswordEmail',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users/{user-id}/reset-password-email',
    'summary' => 'Send an email to the user with a link they can click to reset their password',
    'description' => 'The redirectUri and clientId parameters are optional. The default for the redirect is the account client. This endpoint has been deprecated. Please use the execute-actions-email passing a list with UPDATE_PASSWORD within it.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'client id',
      ),
      'redirect_uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'redirect uri',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
      'client_id' => 'client_id',
      'redirect_uri' => 'redirect_uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_users_user_id_send_verify_email' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_users_user_id_send_verify_email',
    'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdSendVerifyEmail',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/users/{user-id}/send-verify-email',
    'summary' => 'Send an email-verification email to the user An email contains a link the user can click to verify their email address',
    'description' => 'The redirectUri, clientId and lifespan parameters are optional. The default for the redirect is the account client. The default for the lifespan is 12 hours',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Official Keycloak path parameter `user-id`.',
      ),
      'client_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Client id',
      ),
      'lifespan' =>
      array (
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of seconds after which the generated token expires',
      ),
      'redirect_uri' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Redirect uri',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'user-id' => 'user_id',
    ),
    'query_params' =>
    array (
      'client_id' => 'client_id',
      'lifespan' => 'lifespan',
      'redirect_uri' => 'redirect_uri',
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => NULL,
    'type' => 'write',
  ),
  'keycloak_put_admin_realms_realm_workflows_id' =>
  array (
    'slug' => 'keycloak_put_admin_realms_realm_workflows_id',
    'class' => 'KeycloakPutAdminRealmsRealmWorkflowsId',
    'method' => 'PUT',
    'path' => '/admin/realms/{realm}/workflows/{id}',
    'summary' => 'Update workflow',
    'description' => 'Update the workflow configuration. This method does not update the workflow steps.',
    'parameters' =>
    array (
      'realm' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'realm name (not id!)',
      ),
      'id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow identifier',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => false,
        'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
      ),
    ),
    'path_params' =>
    array (
      'realm' => 'realm',
      'id' => 'id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'body_required' => false,
    'content_type' => 'application/yaml',
    'type' => 'write',
  ),
);
    }
}
