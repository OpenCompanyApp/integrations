<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove organization application.
 *
 * Maps to DELETE /api/organizations/{id}/applications/{applicationId} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_application',
  'class' => 'LogtoDeleteOrganizationApplication',
  'method' => 'DELETE',
  'path' => '/api/organizations/{id}/applications/{applicationId}',
  'operation_id' => 'DeleteOrganizationApplication',
  'summary' => 'Remove organization application',
  'description' => 'Remove an application from the organization.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'applicationId' => 'application_id',
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
