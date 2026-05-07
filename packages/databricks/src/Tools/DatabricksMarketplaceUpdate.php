<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Marketplace Update.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.1/marketplace-consumer/listings/{listing_id}/installations/{installation_id}.
 */
class DatabricksMarketplaceUpdate extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_marketplace_update';
    protected const DESCRIPTION = 'Marketplace Update

Official Databricks SDK endpoint: PUT /api/2.1/marketplace-consumer/listings/{listing_id}/installations/{installation_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'listing_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `listing_id` from the Databricks SDK endpoint.',
  ),
  'installation_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `installation_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/marketplace-consumer/listings/{listing_id}/installations/{installation_id}';
    protected const PATH_PARAMS = array (
  'listing_id' => 'listing_id',
  'installation_id' => 'installation_id',
);
}
