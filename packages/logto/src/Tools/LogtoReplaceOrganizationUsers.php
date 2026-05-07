<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Replace organization user members.
 *
 * Maps to PUT /api/organizations/{id}/users in the official Logto OpenAPI source.
 */
class LogtoReplaceOrganizationUsers extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_organization_users',
  'class' => 'LogtoReplaceOrganizationUsers',
  'method' => 'PUT',
  'path' => '/api/organizations/{id}/users',
  'operation_id' => 'ReplaceOrganizationUsers',
  'summary' => 'Replace organization user members',
  'description' => 'Replace all user members for the specified organization with the given users. This effectively removing all existing user memberships in the organization and adding the new users as members.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
