<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Create Policy.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/unity-catalog/policies.
 */
class DatabricksCatalogCreatePolicy extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_create_policy';
    protected const DESCRIPTION = 'Catalog Create Policy

Official Databricks SDK endpoint: POST /api/2.1/unity-catalog/policies

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
    protected const PATH = '/api/2.1/unity-catalog/policies';
    protected const PATH_PARAMS = array (
);
}
