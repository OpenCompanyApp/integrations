<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dataclassification Create Catalog Config.
 *
 * Maps to the official Databricks SDK endpoint post /api/data-classification/v1/{parent}/config.
 */
class DatabricksDataclassificationCreateCatalogConfig extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dataclassification_create_catalog_config';
    protected const DESCRIPTION = 'Dataclassification Create Catalog Config

Official Databricks SDK endpoint: POST /api/data-classification/v1/{parent}/config

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
    protected const PATH = '/api/data-classification/v1/{parent}/config';
    protected const PATH_PARAMS = array (
  'parent' => 'parent',
);
}
