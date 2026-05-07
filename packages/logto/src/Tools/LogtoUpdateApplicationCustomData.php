<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update application custom data.
 *
 * Maps to PATCH /api/applications/{applicationId}/custom-data in the official Logto OpenAPI source.
 */
class LogtoUpdateApplicationCustomData extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_application_custom_data',
  'class' => 'LogtoUpdateApplicationCustomData',
  'method' => 'PATCH',
  'path' => '/api/applications/{applicationId}/custom-data',
  'operation_id' => 'UpdateApplicationCustomData',
  'summary' => 'Update application custom data',
  'description' => 'Update the custom data of an application.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
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
    'applicationId' => 'application_id',
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
