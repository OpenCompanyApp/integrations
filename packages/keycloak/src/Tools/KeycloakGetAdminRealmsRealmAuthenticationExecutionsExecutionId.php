<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get Single Execution.
 *
 * Maps to GET /admin/realms/{realm}/authentication/executions/{executionId} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationExecutionsExecutionId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
