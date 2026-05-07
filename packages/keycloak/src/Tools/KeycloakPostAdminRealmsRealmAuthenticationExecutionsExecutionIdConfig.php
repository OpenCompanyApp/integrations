<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update execution with new configuration.
 *
 * Maps to POST /admin/realms/{realm}/authentication/executions/{executionId}/config in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmAuthenticationExecutionsExecutionIdConfig extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
