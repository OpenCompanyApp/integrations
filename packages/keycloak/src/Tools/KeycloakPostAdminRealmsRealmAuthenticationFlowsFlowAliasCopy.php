<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Copy existing authentication flow under a new name The new name is given as 'newName' attribute of the passed JSON object.
 *
 * Maps to POST /admin/realms/{realm}/authentication/flows/{flowAlias}/copy in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasCopy extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_copy',
  'class' => 'KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasCopy',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/authentication/flows/{flowAlias}/copy',
  'summary' => 'Copy existing authentication flow under a new name The new name is given as \'newName\' attribute of the passed JSON object',
  'description' => 'Copy existing authentication flow under a new name The new name is given as \'newName\' attribute of the passed JSON object.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'flow_alias' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'name of the existing authentication flow',
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
    'flowAlias' => 'flow_alias',
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
