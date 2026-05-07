<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get invitations for the organization.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/invitations in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdInvitations extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_invitations',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdInvitations',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/invitations',
  'summary' => 'Get invitations for the organization',
  'description' => 'Get invitations for the organization.',
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
    'email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `email`.',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Official Keycloak query parameter `first`.',
    ),
    'first_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `firstName`.',
    ),
    'last_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `lastName`.',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Official Keycloak query parameter `max`.',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `search`.',
    ),
    'status' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `status`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'org-id' => 'org_id',
  ),
  'query_params' =>
  array (
    'email' => 'email',
    'first' => 'first',
    'firstName' => 'first_name',
    'lastName' => 'last_name',
    'max' => 'max',
    'search' => 'search',
    'status' => 'status',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
