<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve System Health With Id.
 *
 * Maps to GET /api/health in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveSystemHealthWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_system_health_with_id',
  'class' => 'FusionAuthRetrieveSystemHealthWithId',
  'method' => 'GET',
  'path' => '/api/health',
  'operation_id' => 'retrieveSystemHealthWithId',
  'summary' => 'retrieve System Health With Id',
  'description' => 'Retrieves the FusionAuth system health. This API will return 200 if the system is healthy, and 500 if the system is un-healthy.',
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
