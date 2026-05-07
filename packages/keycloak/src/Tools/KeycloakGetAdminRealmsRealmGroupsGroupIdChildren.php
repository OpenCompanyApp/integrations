<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Return a paginated list of subgroups that have a parent group corresponding to the group on the URL.
 *
 * Maps to GET /admin/realms/{realm}/groups/{group-id}/children in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmGroupsGroupIdChildren extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_children',
  'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdChildren',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/groups/{group-id}/children',
  'summary' => 'Return a paginated list of subgroups that have a parent group corresponding to the group on the URL',
  'description' => 'Return a paginated list of subgroups that have a parent group corresponding to the group on the URL.',
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
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether brief groups representations are returned or not (default: false)',
    ),
    'exact' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether the params "search" must match exactly or not',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The position of the first result to be returned (pagination offset).',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The maximum number of results that are to be returned. Defaults to 10',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String representing either an exact group name or a partial name, defaults to prefix search.',
    ),
    'sub_groups_count' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether to return the count of subgroups for each subgroup of this group (default: true)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'group-id' => 'group_id',
  ),
  'query_params' =>
  array (
    'briefRepresentation' => 'brief_representation',
    'exact' => 'exact',
    'first' => 'first',
    'max' => 'max',
    'search' => 'search',
    'subGroupsCount' => 'sub_groups_count',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
