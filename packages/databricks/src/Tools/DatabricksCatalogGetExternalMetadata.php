<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Get External Metadata.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/lineage-tracking/external-metadata/{name}.
 */
class DatabricksCatalogGetExternalMetadata extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_get_external_metadata';
    protected const DESCRIPTION = 'Catalog Get External Metadata

Official Databricks SDK endpoint: GET /api/2.0/lineage-tracking/external-metadata/{name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/lineage-tracking/external-metadata/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
