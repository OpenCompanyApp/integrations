<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create an organization role.
 *
 * Maps to POST /api/organization-roles in the official Logto OpenAPI source.
 */
class LogtoCreateOrganizationRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_organization_role',
  'class' => 'LogtoCreateOrganizationRole',
  'method' => 'POST',
  'path' => '/api/organization-roles',
  'operation_id' => 'CreateOrganizationRole',
  'summary' => 'Create an organization role',
  'description' => 'Create a new organization role with the given data.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
