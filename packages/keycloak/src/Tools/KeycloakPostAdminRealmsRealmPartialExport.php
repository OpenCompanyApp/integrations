<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Partial export of existing realm into a JSON file.
 *
 * Maps to POST /admin/realms/{realm}/partial-export in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmPartialExport extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_partial_export',
  'class' => 'KeycloakPostAdminRealmsRealmPartialExport',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/partial-export',
  'summary' => 'Partial export of existing realm into a JSON file',
  'description' => 'Partial export of existing realm into a JSON file.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'export_clients' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `exportClients`.',
    ),
    'export_groups_and_roles' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `exportGroupsAndRoles`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'exportClients' => 'export_clients',
    'exportGroupsAndRoles' => 'export_groups_and_roles',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
