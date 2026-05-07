<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Batch Create Access Requests.
 *
 * Maps to the official Databricks SDK endpoint post /api/3.0/rfa/requests.
 */
class DatabricksCatalogBatchCreateAccessRequests extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_batch_create_access_requests';
    protected const DESCRIPTION = 'Catalog Batch Create Access Requests

Official Databricks SDK endpoint: POST /api/3.0/rfa/requests

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
    protected const PATH = '/api/3.0/rfa/requests';
    protected const PATH_PARAMS = array (
);
}
