<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Import identity provider from JSON body.
 *
 * Maps to POST /admin/realms/{realm}/identity-provider/import-config in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmIdentityProviderImportConfig extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_identity_provider_import_config',
  'class' => 'KeycloakPostAdminRealmsRealmIdentityProviderImportConfig',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/identity-provider/import-config',
  'summary' => 'Import identity provider from JSON body',
  'description' => 'Import identity provider from uploaded JSON file',
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
