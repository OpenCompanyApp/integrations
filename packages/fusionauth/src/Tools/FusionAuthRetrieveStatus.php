<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Status.
 *
 * Maps to GET /api/status in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveStatus extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_status',
  'class' => 'FusionAuthRetrieveStatus',
  'method' => 'GET',
  'path' => '/api/status',
  'operation_id' => 'retrieveStatus',
  'summary' => 'retrieve Status',
  'description' => 'Retrieves the FusionAuth system status using an API key. Using an API key will cause the response to include the product version, health checks and various runtime metrics. OR Retrieves the FusionAuth system status. This request is anonymous and does not require an API key. When an API key is not provided the response will contain a single value in the JSON response indicating the current health check.',
  'parameters' =>
  array (
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
  'content_type' => NULL,
  'type' => 'read',
);
}
