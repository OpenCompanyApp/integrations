<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog List Policies.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/unity-catalog/policies/{on_securable_type}/{on_securable_fullname}.
 */
class DatabricksCatalogListPolicies extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_list_policies';
    protected const DESCRIPTION = 'Catalog List Policies

Official Databricks SDK endpoint: GET /api/2.1/unity-catalog/policies/{on_securable_type}/{on_securable_fullname}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'on_securable_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `on_securable_type` from the Databricks SDK endpoint.',
  ),
  'on_securable_fullname' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `on_securable_fullname` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/policies/{on_securable_type}/{on_securable_fullname}';
    protected const PATH_PARAMS = array (
  'on_securable_type' => 'on_securable_type',
  'on_securable_fullname' => 'on_securable_fullname',
);
}
