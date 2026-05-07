<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Set Alias.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.1/unity-catalog/models/{full_name}/aliases/{alias}.
 */
class DatabricksCatalogSetAlias extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_set_alias';
    protected const DESCRIPTION = 'Catalog Set Alias

Official Databricks SDK endpoint: PUT /api/2.1/unity-catalog/models/{full_name}/aliases/{alias}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'full_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `full_name` from the Databricks SDK endpoint.',
  ),
  'alias' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `alias` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.1/unity-catalog/models/{full_name}/aliases/{alias}';
    protected const PATH_PARAMS = array (
  'full_name' => 'full_name',
  'alias' => 'alias',
);
}
