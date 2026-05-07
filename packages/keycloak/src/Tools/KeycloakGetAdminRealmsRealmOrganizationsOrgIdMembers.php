<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns a paginated list of organization members filtered according to the specified parameters.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/members in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_members',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembers',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/members',
  'summary' => 'Returns a paginated list of organization members filtered according to the specified parameters',
  'description' => 'Returns a paginated list of organization members filtered according to the specified parameters.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'org_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `org-id`.',
    ),
    'exact' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether the param \'search\' must match exactly or not',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The position of the first result to be processed (pagination offset)',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The maximum number of results to be returned. Defaults to 10',
    ),
    'membership_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The membership type',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String representing either a member\'s username, e-mail, first name, or last name.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'org-id' => 'org_id',
  ),
  'query_params' =>
  array (
    'exact' => 'exact',
    'first' => 'first',
    'max' => 'max',
    'membershipType' => 'membership_type',
    'search' => 'search',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
