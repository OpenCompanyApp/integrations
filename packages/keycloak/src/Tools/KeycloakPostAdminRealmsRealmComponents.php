<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * POST /admin/realms/{realm}/components.
 *
 * Maps to POST /admin/realms/{realm}/components in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmComponents extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_components',
  'class' => 'KeycloakPostAdminRealmsRealmComponents',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/components',
  'summary' => 'POST /admin/realms/{realm}/components',
  'description' => 'POST /admin/realms/{realm}/components.',
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
