<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Get Online Store.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/feature-store/online-stores/{name}.
 */
class DatabricksMlGetOnlineStore extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_get_online_store';
    protected const DESCRIPTION = 'Ml Get Online Store

Official Databricks SDK endpoint: GET /api/2.0/feature-store/online-stores/{name}

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/feature-store/online-stores/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
