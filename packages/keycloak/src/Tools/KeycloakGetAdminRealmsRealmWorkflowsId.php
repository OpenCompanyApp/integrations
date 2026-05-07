<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get workflow.
 *
 * Maps to GET /admin/realms/{realm}/workflows/{id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmWorkflowsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
