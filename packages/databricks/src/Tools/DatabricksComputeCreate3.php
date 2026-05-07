<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Create.
 *
 * Maps to the official Databricks SDK endpoint post /api/1.2/contexts/create.
 */
class DatabricksComputeCreate3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_create_3';
    protected const DESCRIPTION = 'Compute Create

Official Databricks SDK endpoint: POST /api/1.2/contexts/create

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
    protected const PATH = '/api/1.2/contexts/create';
    protected const PATH_PARAMS = array (
);
}
