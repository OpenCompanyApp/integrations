<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Integrations With Id.
 *
 * Maps to PATCH /api/integration in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchIntegrationsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_integrations_with_id',
  'class' => 'FusionAuthPatchIntegrationsWithId',
  'method' => 'PATCH',
  'path' => '/api/integration',
  'operation_id' => 'patchIntegrationsWithId',
  'summary' => 'patch Integrations With Id',
  'description' => 'Updates, via PATCH, the available integrations.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
