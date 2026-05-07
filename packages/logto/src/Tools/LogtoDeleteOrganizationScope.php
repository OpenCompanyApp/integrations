<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete organization scope.
 *
 * Maps to DELETE /api/organization-scopes/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_scope',
  'class' => 'LogtoDeleteOrganizationScope',
  'method' => 'DELETE',
  'path' => '/api/organization-scopes/{id}',
  'operation_id' => 'DeleteOrganizationScope',
  'summary' => 'Delete organization scope',
  'description' => 'Delete organization scope by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization scope.',
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
