<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Pin.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/clusters/pin.
 */
class DatabricksComputePin extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_pin';
    protected const DESCRIPTION = 'Compute Pin

Official Databricks SDK endpoint: POST /api/2.1/clusters/pin

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
    protected const PATH = '/api/2.1/clusters/pin';
    protected const PATH_PARAMS = array (
);
}
