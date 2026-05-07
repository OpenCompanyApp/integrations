<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Get Quota.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/unity-catalog/resource-quotas/{parent_securable_type}/{parent_full_name}/{quota_name}.
 */
class DatabricksCatalogGetQuota extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_get_quota';
    protected const DESCRIPTION = 'Catalog Get Quota

Official Databricks SDK endpoint: GET /api/2.1/unity-catalog/resource-quotas/{parent_securable_type}/{parent_full_name}/{quota_name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'parent_securable_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent_securable_type` from the Databricks SDK endpoint.',
  ),
  'parent_full_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent_full_name` from the Databricks SDK endpoint.',
  ),
  'quota_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `quota_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/resource-quotas/{parent_securable_type}/{parent_full_name}/{quota_name}';
    protected const PATH_PARAMS = array (
  'parent_securable_type' => 'parent_securable_type',
  'parent_full_name' => 'parent_full_name',
  'quota_name' => 'quota_name',
);
}
