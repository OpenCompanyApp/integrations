<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Replace organization applications.
 *
 * Maps to PUT /api/organizations/{id}/applications in the official Logto OpenAPI source.
 */
class LogtoReplaceOrganizationApplications extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_organization_applications',
  'class' => 'LogtoReplaceOrganizationApplications',
  'method' => 'PUT',
  'path' => '/api/organizations/{id}/applications',
  'operation_id' => 'ReplaceOrganizationApplications',
  'summary' => 'Replace organization applications',
  'description' => 'Replace all applications associated with the organization with the given data.',
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
