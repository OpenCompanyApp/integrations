<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Application With Id.
 *
 * Maps to POST /api/application/{applicationId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateApplicationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_application_with_id',
  'class' => 'FusionAuthCreateApplicationWithId',
  'method' => 'POST',
  'path' => '/api/application/{applicationId}',
  'operation_id' => 'createApplicationWithId',
  'summary' => 'create Application With Id',
  'description' => 'Creates an application. You can optionally specify an Id for the application, if not provided one will be generated.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id to use for the application. If not provided a secure random UUID will be generated.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
