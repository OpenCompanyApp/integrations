<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Application.
 *
 * Maps to GET /api/application in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveApplication extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_application',
  'class' => 'FusionAuthRetrieveApplication',
  'method' => 'GET',
  'path' => '/api/application',
  'operation_id' => 'retrieveApplication',
  'summary' => 'retrieve Application',
  'description' => 'Retrieves all the applications that are currently inactive. OR Retrieves the application for the given Id or all the applications if the Id is null.',
  'parameters' =>
  array (
    'inactive' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `inactive`.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'inactive' => 'inactive',
  ),
  'header_params' =>
  array (
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
