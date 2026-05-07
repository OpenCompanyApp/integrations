<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Application With Id.
 *
 * Maps to GET /api/application/{applicationId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveApplicationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_application_with_id',
  'class' => 'FusionAuthRetrieveApplicationWithId',
  'method' => 'GET',
  'path' => '/api/application/{applicationId}',
  'operation_id' => 'retrieveApplicationWithId',
  'summary' => 'retrieve Application With Id',
  'description' => 'Retrieves the application for the given Id or all the applications if the Id is null.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The application Id.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
