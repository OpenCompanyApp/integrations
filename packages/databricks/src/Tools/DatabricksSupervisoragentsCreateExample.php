<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Supervisoragents Create Example.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/{parent}/examples.
 */
class DatabricksSupervisoragentsCreateExample extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_supervisoragents_create_example';
    protected const DESCRIPTION = 'Supervisoragents Create Example

Official Databricks SDK endpoint: POST /api/2.1/{parent}/examples

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the Databricks SDK endpoint.',
  ),
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
    protected const PATH = '/api/2.1/{parent}/examples';
    protected const PATH_PARAMS = array (
  'parent' => 'parent',
);
}
