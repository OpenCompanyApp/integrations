<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get execution's configuration.
 *
 * Maps to GET /admin/realms/{realm}/authentication/executions/{executionId}/config/{id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationExecutionsExecutionIdConfigId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
