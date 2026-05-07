<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/unity-catalog/entity-tag-assignments/{entity_type}/{entity_name}/tags/{tag_key}.
 */
class DatabricksCatalogGet7 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_get_7';
    protected const DESCRIPTION = 'Catalog Get

Official Databricks SDK endpoint: GET /api/2.1/unity-catalog/entity-tag-assignments/{entity_type}/{entity_name}/tags/{tag_key}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'entity_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entity_type` from the Databricks SDK endpoint.',
  ),
  'entity_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entity_name` from the Databricks SDK endpoint.',
  ),
  'tag_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_key` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/entity-tag-assignments/{entity_type}/{entity_name}/tags/{tag_key}';
    protected const PATH_PARAMS = array (
  'entity_type' => 'entity_type',
  'entity_name' => 'entity_name',
  'tag_key' => 'tag_key',
);
}
