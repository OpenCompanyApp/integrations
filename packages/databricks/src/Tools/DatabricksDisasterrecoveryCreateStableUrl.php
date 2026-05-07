<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Disasterrecovery Create Stable Url.
 *
 * Maps to the official Databricks SDK endpoint post /api/disaster-recovery/v1/{parent}/stable-urls.
 */
class DatabricksDisasterrecoveryCreateStableUrl extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_disasterrecovery_create_stable_url';
    protected const DESCRIPTION = 'Disasterrecovery Create Stable Url

Official Databricks SDK endpoint: POST /api/disaster-recovery/v1/{parent}/stable-urls

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
    protected const METHOD = 'post';
    protected const PATH = '/api/disaster-recovery/v1/{parent}/stable-urls';
    protected const PATH_PARAMS = array (
  'parent' => 'parent',
);
}
