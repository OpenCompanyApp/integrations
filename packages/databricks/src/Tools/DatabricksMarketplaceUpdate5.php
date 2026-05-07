<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Marketplace Update.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/marketplace-provider/listings/{listing_id}/personalization-requests/{request_id}/request-status.
 */
class DatabricksMarketplaceUpdate5 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_marketplace_update_5';
    protected const DESCRIPTION = 'Marketplace Update

Official Databricks SDK endpoint: PUT /api/2.0/marketplace-provider/listings/{listing_id}/personalization-requests/{request_id}/request-status

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'listing_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `listing_id` from the Databricks SDK endpoint.',
  ),
  'request_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `request_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/marketplace-provider/listings/{listing_id}/personalization-requests/{request_id}/request-status';
    protected const PATH_PARAMS = array (
  'listing_id' => 'listing_id',
  'request_id' => 'request_id',
);
}
