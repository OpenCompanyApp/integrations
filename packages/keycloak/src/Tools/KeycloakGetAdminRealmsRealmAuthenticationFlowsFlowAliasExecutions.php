<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get authentication executions for a flow.
 *
 * Maps to GET /admin/realms/{realm}/authentication/flows/{flowAlias}/executions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationFlowsFlowAliasExecutions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_flows_flow_alias_executions',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFlowsFlowAliasExecutions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/flows/{flowAlias}/executions',
  'summary' => 'Get authentication executions for a flow',
  'description' => 'Get authentication executions for a flow.',
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
      'description' => 'Flow alias',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
