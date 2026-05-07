<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get scopes for a user in an organization tailored by the organization roles.
 *
 * Maps to GET /api/organizations/{id}/users/{userId}/scopes in the official Logto OpenAPI source.
 */
class LogtoListOrganizationUserScopes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_user_scopes',
  'class' => 'LogtoListOrganizationUserScopes',
  'method' => 'GET',
  'path' => '/api/organizations/{id}/users/{userId}/scopes',
  'operation_id' => 'ListOrganizationUserScopes',
  'summary' => 'Get scopes for a user in an organization tailored by the organization roles',
  'description' => 'Get scopes assigned to a user in the specified organization tailored by the organization roles. The scopes are derived from the organization roles assigned to the user.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'userId' => 'user_id',
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
