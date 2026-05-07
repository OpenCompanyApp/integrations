<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization.
 *
 * Maps to GET /api/organizations/{id} in the official Logto OpenAPI source.
 */
class LogtoGetOrganization extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_organization',
  'class' => 'LogtoGetOrganization',
  'method' => 'GET',
  'path' => '/api/organizations/{id}',
  'operation_id' => 'GetOrganization',
  'summary' => 'Get organization',
  'description' => 'Get organization details by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
