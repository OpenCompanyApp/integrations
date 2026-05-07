<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Marketplace Delete Listing From Exchange.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/marketplace-exchange/exchanges-for-listing/{id}.
 */
class DatabricksMarketplaceDeleteListingFromExchange extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_marketplace_delete_listing_from_exchange';
    protected const DESCRIPTION = 'Marketplace Delete Listing From Exchange

Official Databricks SDK endpoint: DELETE /api/2.0/marketplace-exchange/exchanges-for-listing/{id}

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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/marketplace-exchange/exchanges-for-listing/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
}
