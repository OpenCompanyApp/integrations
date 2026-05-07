<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Execute.
 *
 * Maps to the official Databricks SDK endpoint post /api/1.2/commands/execute.
 */
class DatabricksComputeExecute extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_execute';
    protected const DESCRIPTION = 'Compute Execute

Official Databricks SDK endpoint: POST /api/1.2/commands/execute

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
    protected const PATH = '/api/1.2/commands/execute';
    protected const PATH_PARAMS = array (
);
}
