<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete execution.
 *
 * Maps to DELETE /admin/realms/{realm}/authentication/executions/{executionId} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmAuthenticationExecutionsExecutionId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
