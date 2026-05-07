<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Application With Id.
 *
 * Maps to PATCH /api/application/{applicationId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchApplicationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_application_with_id',
  'class' => 'FusionAuthPatchApplicationWithId',
  'method' => 'PATCH',
  'path' => '/api/application/{applicationId}',
  'operation_id' => 'patchApplicationWithId',
  'summary' => 'patch Application With Id',
  'description' => 'Updates, via PATCH, the application with the given Id.',
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
