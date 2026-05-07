<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Base path for importing clients under this realm.
 *
 * Maps to POST /admin/realms/{realm}/client-description-converter in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientDescriptionConverter extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_client_description_converter',
  'class' => 'KeycloakPostAdminRealmsRealmClientDescriptionConverter',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/client-description-converter',
  'summary' => 'Base path for importing clients under this realm',
  'description' => 'Base path for importing clients under this realm.',
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
