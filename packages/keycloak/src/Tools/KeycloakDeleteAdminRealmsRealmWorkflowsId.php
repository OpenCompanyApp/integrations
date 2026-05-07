<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete workflow.
 *
 * Maps to DELETE /admin/realms/{realm}/workflows/{id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmWorkflowsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
