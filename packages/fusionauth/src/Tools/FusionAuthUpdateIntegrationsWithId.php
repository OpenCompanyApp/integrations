<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Integrations With Id.
 *
 * Maps to PUT /api/integration in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateIntegrationsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_integrations_with_id',
  'class' => 'FusionAuthUpdateIntegrationsWithId',
  'method' => 'PUT',
  'path' => '/api/integration',
  'operation_id' => 'updateIntegrationsWithId',
  'summary' => 'update Integrations With Id',
  'description' => 'Updates the available integrations.',
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
