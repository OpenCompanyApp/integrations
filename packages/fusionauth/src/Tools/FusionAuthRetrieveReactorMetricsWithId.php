<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Reactor Metrics With Id.
 *
 * Maps to GET /api/reactor/metrics in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveReactorMetricsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_reactor_metrics_with_id',
  'class' => 'FusionAuthRetrieveReactorMetricsWithId',
  'method' => 'GET',
  'path' => '/api/reactor/metrics',
  'operation_id' => 'retrieveReactorMetricsWithId',
  'summary' => 'retrieve Reactor Metrics With Id',
  'description' => 'Retrieves the FusionAuth Reactor metrics.',
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
