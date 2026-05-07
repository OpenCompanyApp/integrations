<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Creates a new organization.
 *
 * Maps to POST /admin/realms/{realm}/organizations in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmOrganizations extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_organizations',
  'class' => 'KeycloakPostAdminRealmsRealmOrganizations',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/organizations',
  'summary' => 'Creates a new organization',
  'description' => 'Creates a new organization.',
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
