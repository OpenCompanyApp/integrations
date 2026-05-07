<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Migrate scheduled resources from one step to another.
 *
 * Maps to POST /admin/realms/{realm}/workflows/migrate in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmWorkflowsMigrate extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_workflows_migrate',
  'class' => 'KeycloakPostAdminRealmsRealmWorkflowsMigrate',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/workflows/migrate',
  'summary' => 'Migrate scheduled resources from one step to another',
  'description' => 'Migrate scheduled resources from one step to another step in the same or in a different workflow.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'from' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String representing the id of the step to migrate from',
    ),
    'to' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String representing the id of the step to migrate to',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'from' => 'from',
    'to' => 'to',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
