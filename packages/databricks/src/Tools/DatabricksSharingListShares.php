<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sharing List Shares.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/unity-catalog/providers/{name}/shares.
 */
class DatabricksSharingListShares extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sharing_list_shares';
    protected const DESCRIPTION = 'Sharing List Shares

Official Databricks SDK endpoint: GET /api/2.1/unity-catalog/providers/{name}/shares

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
    protected const PATH = '/api/2.1/unity-catalog/providers/{name}/shares';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
