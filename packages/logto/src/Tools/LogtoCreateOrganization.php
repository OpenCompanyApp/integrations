<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create an organization.
 *
 * Maps to POST /api/organizations in the official Logto OpenAPI source.
 */
class LogtoCreateOrganization extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_organization',
  'class' => 'LogtoCreateOrganization',
  'method' => 'POST',
  'path' => '/api/organizations',
  'operation_id' => 'CreateOrganization',
  'summary' => 'Create an organization',
  'description' => 'Create a new organization with the given data.',
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
