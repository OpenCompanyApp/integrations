<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove user member from organization.
 *
 * Maps to DELETE /api/organizations/{id}/users/{userId} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationUser extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_user',
  'class' => 'LogtoDeleteOrganizationUser',
  'method' => 'DELETE',
  'path' => '/api/organizations/{id}/users/{userId}',
  'operation_id' => 'DeleteOrganizationUser',
  'summary' => 'Remove user member from organization',
  'description' => 'Remove a user\'s membership from the specified organization.',
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
  'type' => 'write',
);
}
