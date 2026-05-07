<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Set or create child.
 *
 * Maps to POST /admin/realms/{realm}/groups/{group-id}/children in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmGroupsGroupIdChildren extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_groups_group_id_children',
  'class' => 'KeycloakPostAdminRealmsRealmGroupsGroupIdChildren',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/groups/{group-id}/children',
  'summary' => 'Set or create child',
  'description' => 'This will just set the parent if it exists. Create it and set the parent if the group doesn’t exist.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `group-id`.',
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
    'group-id' => 'group_id',
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
