<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete organization.
 *
 * Maps to DELETE /api/organizations/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganization extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization',
  'class' => 'LogtoDeleteOrganization',
  'method' => 'DELETE',
  'path' => '/api/organizations/{id}',
  'operation_id' => 'DeleteOrganization',
  'summary' => 'Delete organization',
  'description' => 'Delete organization by ID.',
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
  'type' => 'write',
);
}
