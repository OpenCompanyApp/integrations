<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Marketplace Add Listing To Exchange.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/marketplace-exchange/exchanges-for-listing.
 */
class DatabricksMarketplaceAddListingToExchange extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_marketplace_add_listing_to_exchange';
    protected const DESCRIPTION = 'Marketplace Add Listing To Exchange

Official Databricks SDK endpoint: POST /api/2.0/marketplace-exchange/exchanges-for-listing

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
    protected const PATH = '/api/2.0/marketplace-exchange/exchanges-for-listing';
    protected const PATH_PARAMS = array (
);
}
