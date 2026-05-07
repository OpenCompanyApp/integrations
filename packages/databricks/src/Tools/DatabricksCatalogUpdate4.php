<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Update.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.1/unity-catalog/artifact-allowlists/{artifact_type}.
 */
class DatabricksCatalogUpdate4 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_update_4';
    protected const DESCRIPTION = 'Catalog Update

Official Databricks SDK endpoint: PUT /api/2.1/unity-catalog/artifact-allowlists/{artifact_type}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'artifact_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `artifact_type` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/artifact-allowlists/{artifact_type}';
    protected const PATH_PARAMS = array (
  'artifact_type' => 'artifact_type',
);
}
