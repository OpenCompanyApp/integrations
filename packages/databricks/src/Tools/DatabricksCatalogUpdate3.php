<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Update.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/accounts/{account_id}/metastores/{metastore_id}/storage-credentials/{storage_credential_name}.
 */
class DatabricksCatalogUpdate3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_update_3';
    protected const DESCRIPTION = 'Catalog Update

Official Databricks SDK endpoint: PUT /api/2.0/accounts/{account_id}/metastores/{metastore_id}/storage-credentials/{storage_credential_name}

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
  'storage_credential_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `storage_credential_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/metastores/{metastore_id}/storage-credentials/{storage_credential_name}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'metastore_id' => 'metastore_id',
  'storage_credential_name' => 'storage_credential_name',
);
}
