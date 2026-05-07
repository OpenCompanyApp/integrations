<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * List of subcomponent types that are available to configure for a particular parent component.
 *
 * Maps to GET /admin/realms/{realm}/components/{id}/sub-component-types in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmComponentsIdSubComponentTypes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_components_id_sub_component_types',
  'class' => 'KeycloakGetAdminRealmsRealmComponentsIdSubComponentTypes',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/components/{id}/sub-component-types',
  'summary' => 'List of subcomponent types that are available to configure for a particular parent component',
  'description' => 'List of subcomponent types that are available to configure for a particular parent component.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `id`.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `type`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'id' => 'id',
  ),
  'query_params' =>
  array (
    'type' => 'type',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
