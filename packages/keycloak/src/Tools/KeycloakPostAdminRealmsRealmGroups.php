<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * create or add a top level realm groupSet or create child.
 *
 * Maps to POST /admin/realms/{realm}/groups in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmGroups extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_groups',
  'class' => 'KeycloakPostAdminRealmsRealmGroups',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/groups',
  'summary' => 'create or add a top level realm groupSet or create child',
  'description' => 'This will update the group and set the parent if it exists. Create it and set the parent if the group doesn’t exist.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
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
