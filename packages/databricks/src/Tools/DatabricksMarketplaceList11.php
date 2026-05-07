<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Marketplace List.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/marketplace-provider/providers.
 */
class DatabricksMarketplaceList11 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_marketplace_list_11';
    protected const DESCRIPTION = 'Marketplace List

Official Databricks SDK endpoint: GET /api/2.0/marketplace-provider/providers

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/marketplace-provider/providers';
    protected const PATH_PARAMS = array (
);
}
