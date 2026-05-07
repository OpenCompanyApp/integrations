<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Events.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/clusters/events.
 */
class DatabricksComputeEvents extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_events';
    protected const DESCRIPTION = 'Compute Events

Official Databricks SDK endpoint: POST /api/2.1/clusters/events

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Optional query string parameters matching the Databricks REST API request fields.',
  ),
  'headers' =>
  array (
    'type' => 'object',
    'description' => 'Optional additional request headers for advanced Databricks endpoints.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional JSON request body matching the Databricks REST API request fields.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/2.1/clusters/events';
    protected const PATH_PARAMS = array (
);
}
