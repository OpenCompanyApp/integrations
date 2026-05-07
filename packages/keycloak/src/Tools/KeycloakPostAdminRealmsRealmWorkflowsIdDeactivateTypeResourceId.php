<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Deactivate workflow for resource.
 *
 * Maps to POST /admin/realms/{realm}/workflows/{id}/deactivate/{type}/{resourceId} in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmWorkflowsIdDeactivateTypeResourceId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
