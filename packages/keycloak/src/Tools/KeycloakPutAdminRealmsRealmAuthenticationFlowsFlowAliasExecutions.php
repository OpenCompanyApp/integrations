<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update authentication executions of a Flow.
 *
 * Maps to PUT /admin/realms/{realm}/authentication/flows/{flowAlias}/executions in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmAuthenticationFlowsFlowAliasExecutions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_authentication_flows_flow_alias_executions',
  'class' => 'KeycloakPutAdminRealmsRealmAuthenticationFlowsFlowAliasExecutions',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/authentication/flows/{flowAlias}/executions',
  'summary' => 'Update authentication executions of a Flow',
  'description' => 'Update authentication executions of a Flow.',
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
