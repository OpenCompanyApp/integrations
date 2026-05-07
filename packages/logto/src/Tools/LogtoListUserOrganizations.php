<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organizations for a user.
 *
 * Maps to GET /api/users/{userId}/organizations in the official Logto OpenAPI source.
 */
class LogtoListUserOrganizations extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_user_organizations',
  'class' => 'LogtoListUserOrganizations',
  'method' => 'GET',
  'path' => '/api/users/{userId}/organizations',
  'operation_id' => 'ListUserOrganizations',
  'summary' => 'Get organizations for a user',
  'description' => 'Get all organizations that the user is a member of. In each organization object, the user\'s roles in that organization are included in the `organizationRoles` array.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
  ),
  'path_params' =>
  array (
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
