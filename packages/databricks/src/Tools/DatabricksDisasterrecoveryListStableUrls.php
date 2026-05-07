<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Disasterrecovery List Stable Urls.
 *
 * Maps to the official Databricks SDK endpoint get /api/disaster-recovery/v1/{parent}/stable-urls.
 */
class DatabricksDisasterrecoveryListStableUrls extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_disasterrecovery_list_stable_urls';
    protected const DESCRIPTION = 'Disasterrecovery List Stable Urls

Official Databricks SDK endpoint: GET /api/disaster-recovery/v1/{parent}/stable-urls

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/disaster-recovery/v1/{parent}/stable-urls';
    protected const PATH_PARAMS = array (
  'parent' => 'parent',
);
}
