<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update workflow.
 *
 * Maps to PUT /admin/realms/{realm}/workflows/{id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmWorkflowsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
