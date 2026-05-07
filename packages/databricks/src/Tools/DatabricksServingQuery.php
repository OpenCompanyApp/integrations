<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Serving Query.
 *
 * Maps to the official Databricks SDK endpoint post /serving-endpoints/{name}/invocations.
 */
class DatabricksServingQuery extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_serving_query';
    protected const DESCRIPTION = 'Serving Query

Official Databricks SDK endpoint: POST /serving-endpoints/{name}/invocations

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/serving-endpoints/{name}/invocations';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
