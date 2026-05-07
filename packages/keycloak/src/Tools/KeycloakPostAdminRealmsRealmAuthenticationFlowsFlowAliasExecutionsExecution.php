<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add new authentication execution to a flow.
 *
 * Maps to POST /admin/realms/{realm}/authentication/flows/{flowAlias}/executions/execution in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasExecutionsExecution extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_authentication_flows_flow_alias_executions_execution',
  'class' => 'KeycloakPostAdminRealmsRealmAuthenticationFlowsFlowAliasExecutionsExecution',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/authentication/flows/{flowAlias}/executions/execution',
  'summary' => 'Add new authentication execution to a flow',
  'description' => 'Add new authentication execution to a flow.',
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
      'description' => 'Alias of parent flow',
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
