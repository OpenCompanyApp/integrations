<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns the organizations associated with the user that has the specified id.
 *
 * Maps to GET /admin/realms/{realm}/organizations/members/{member-id}/organizations in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsMembersMemberIdOrganizations extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_members_member_id_organizations',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsMembersMemberIdOrganizations',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/members/{member-id}/organizations',
  'summary' => 'Returns the organizations associated with the user that has the specified id',
  'description' => 'Returns the organizations associated with the user that has the specified id.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'member_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `member-id`.',
    ),
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'if false, return the full representation. Otherwise, only the basic fields are returned.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'member-id' => 'member_id',
  ),
  'query_params' =>
  array (
    'briefRepresentation' => 'brief_representation',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
