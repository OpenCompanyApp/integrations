<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Activate workflow for resource.
 *
 * Maps to POST /admin/realms/{realm}/workflows/{id}/activate/{type}/{resourceId} in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmWorkflowsIdActivateTypeResourceId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
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
);
}
