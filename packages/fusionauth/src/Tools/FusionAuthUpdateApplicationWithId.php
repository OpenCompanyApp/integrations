<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Application With Id.
 *
 * Maps to PUT /api/application/{applicationId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateApplicationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_application_with_id',
  'class' => 'FusionAuthUpdateApplicationWithId',
  'method' => 'PUT',
  'path' => '/api/application/{applicationId}',
  'operation_id' => 'updateApplicationWithId',
  'summary' => 'update Application With Id',
  'description' => 'Updates the application with the given Id. OR Reactivates the application with the given Id.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application to update.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
    'reactivate' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `reactivate`.',
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
    'reactivate' => 'reactivate',
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
