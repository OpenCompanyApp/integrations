<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Update Credential.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.1/unity-catalog/credentials/{name_arg}.
 */
class DatabricksCatalogUpdateCredential extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_update_credential';
    protected const DESCRIPTION = 'Catalog Update Credential

Official Databricks SDK endpoint: PATCH /api/2.1/unity-catalog/credentials/{name_arg}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name_arg' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name_arg` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.1/unity-catalog/credentials/{name_arg}';
    protected const PATH_PARAMS = array (
  'name_arg' => 'name_arg',
);
}
