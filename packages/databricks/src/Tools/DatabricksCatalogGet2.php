<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/accounts/{account_id}/metastores/{metastore_id}.
 */
class DatabricksCatalogGet2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_get_2';
    protected const DESCRIPTION = 'Catalog Get

Official Databricks SDK endpoint: GET /api/2.0/accounts/{account_id}/metastores/{metastore_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'metastore_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `metastore_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/metastores/{metastore_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'metastore_id' => 'metastore_id',
);
}
