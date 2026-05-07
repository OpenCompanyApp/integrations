<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * List scheduled workflows for resource.
 *
 * Maps to GET /admin/realms/{realm}/workflows/scheduled/{resource-id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmWorkflowsScheduledResourceId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_workflows_scheduled_resource_id',
  'class' => 'KeycloakGetAdminRealmsRealmWorkflowsScheduledResourceId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/workflows/scheduled/{resource-id}',
  'summary' => 'List scheduled workflows for resource',
  'description' => 'Return workflows that have scheduled steps for the given resource identifier.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'resource_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Identifier of the resource associated with the scheduled workflows',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'resource-id' => 'resource_id',
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
