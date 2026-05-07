<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update organization.
 *
 * Maps to PATCH /api/organizations/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateOrganization extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_organization',
  'class' => 'LogtoUpdateOrganization',
  'method' => 'PATCH',
  'path' => '/api/organizations/{id}',
  'operation_id' => 'UpdateOrganization',
  'summary' => 'Update organization',
  'description' => 'Update organization details by ID with the given data.',
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
