<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Update Access Request Destinations.
 *
 * Maps to the official Databricks SDK endpoint patch /api/3.0/rfa/destinations.
 */
class DatabricksCatalogUpdateAccessRequestDestinations extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_update_access_request_destinations';
    protected const DESCRIPTION = 'Catalog Update Access Request Destinations

Official Databricks SDK endpoint: PATCH /api/3.0/rfa/destinations

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
    protected const METHOD = 'patch';
    protected const PATH = '/api/3.0/rfa/destinations';
    protected const PATH_PARAMS = array (
);
}
