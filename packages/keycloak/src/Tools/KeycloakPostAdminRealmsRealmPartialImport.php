<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Partial import from a JSON file to an existing realm.
 *
 * Maps to POST /admin/realms/{realm}/partialImport in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmPartialImport extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_partial_import',
  'class' => 'KeycloakPostAdminRealmsRealmPartialImport',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/partialImport',
  'summary' => 'Partial import from a JSON file to an existing realm',
  'description' => 'Partial import from a JSON file to an existing realm.',
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
