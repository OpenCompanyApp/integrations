<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Create Credential.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/unity-catalog/credentials.
 */
class DatabricksCatalogCreateCredential extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_create_credential';
    protected const DESCRIPTION = 'Catalog Create Credential

Official Databricks SDK endpoint: POST /api/2.1/unity-catalog/credentials

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
    protected const PATH = '/api/2.1/unity-catalog/credentials';
    protected const PATH_PARAMS = array (
);
}
