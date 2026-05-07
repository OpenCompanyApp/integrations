<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Marketplace Update.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/marketplace-exchange/exchanges/{id}.
 */
class DatabricksMarketplaceUpdate3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_marketplace_update_3';
    protected const DESCRIPTION = 'Marketplace Update

Official Databricks SDK endpoint: PUT /api/2.0/marketplace-exchange/exchanges/{id}

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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/marketplace-exchange/exchanges/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
}
