<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add organization application.
 *
 * Maps to POST /api/organizations/{id}/applications in the official Logto OpenAPI source.
 */
class LogtoAddOrganizationApplications extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_add_organization_applications',
  'class' => 'LogtoAddOrganizationApplications',
  'method' => 'POST',
  'path' => '/api/organizations/{id}/applications',
  'operation_id' => 'AddOrganizationApplications',
  'summary' => 'Add organization application',
  'description' => 'Add an application to the organization.',
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
