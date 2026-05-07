<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Raise execution's priority.
 *
 * Maps to POST /admin/realms/{realm}/authentication/executions/{executionId}/raise-priority in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmAuthenticationExecutionsExecutionIdRaisePriority extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
