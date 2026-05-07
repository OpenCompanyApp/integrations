<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update group, ignores subgroups.
 *
 * Maps to PUT /admin/realms/{realm}/groups/{group-id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmGroupsGroupId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_groups_group_id',
  'class' => 'KeycloakPutAdminRealmsRealmGroupsGroupId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/groups/{group-id}',
  'summary' => 'Update group, ignores subgroups',
  'description' => 'Update group, ignores subgroups.',
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
