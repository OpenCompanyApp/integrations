<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Send an email to the user with a link they can click to execute particular actions.
 *
 * Maps to PUT /admin/realms/{realm}/users/{user-id}/execute-actions-email in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmUsersUserIdExecuteActionsEmail extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_users_user_id_execute_actions_email',
  'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdExecuteActionsEmail',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/users/{user-id}/execute-actions-email',
  'summary' => 'Send an email to the user with a link they can click to execute particular actions',
  'description' => 'An email contains a link the user can click to perform a set of required actions. The redirectUri and clientId parameters are optional. If no redirect is given, then there will be no link back to click after actions have completed. Redirect uri must be a valid uri for the particular clientId.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `user-id`.',
    ),
    'client_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Client id',
    ),
    'lifespan' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Number of seconds after which the generated token expires',
    ),
    'redirect_uri' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Redirect uri',
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
    'user-id' => 'user_id',
  ),
  'query_params' =>
  array (
    'client_id' => 'client_id',
    'lifespan' => 'lifespan',
    'redirect_uri' => 'redirect_uri',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
