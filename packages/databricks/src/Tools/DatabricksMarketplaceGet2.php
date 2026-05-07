<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Marketplace Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/marketplace-consumer/listings/{id}.
 */
class DatabricksMarketplaceGet2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_marketplace_get_2';
    protected const DESCRIPTION = 'Marketplace Get

Official Databricks SDK endpoint: GET /api/2.1/marketplace-consumer/listings/{id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/marketplace-consumer/listings/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
}
