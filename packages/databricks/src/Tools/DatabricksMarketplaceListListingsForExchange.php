<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Marketplace List Listings For Exchange.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/marketplace-exchange/listings-for-exchange.
 */
class DatabricksMarketplaceListListingsForExchange extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_marketplace_list_listings_for_exchange';
    protected const DESCRIPTION = 'Marketplace List Listings For Exchange

Official Databricks SDK endpoint: GET /api/2.0/marketplace-exchange/listings-for-exchange

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
    protected const PATH = '/api/2.0/marketplace-exchange/listings-for-exchange';
    protected const PATH_PARAMS = array (
);
}
