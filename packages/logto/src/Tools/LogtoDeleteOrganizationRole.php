<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete organization role.
 *
 * Maps to DELETE /api/organization-roles/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_role',
  'class' => 'LogtoDeleteOrganizationRole',
  'method' => 'DELETE',
  'path' => '/api/organization-roles/{id}',
  'operation_id' => 'DeleteOrganizationRole',
  'summary' => 'Delete organization role',
  'description' => 'Delete organization role by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization role.',
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
