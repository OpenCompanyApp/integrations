<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Tags Update Tag Assignment.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/entity-tag-assignments/{entity_type}/{entity_id}/tags/{tag_key}.
 */
class DatabricksTagsUpdateTagAssignment extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_tags_update_tag_assignment';
    protected const DESCRIPTION = 'Tags Update Tag Assignment

Official Databricks SDK endpoint: PATCH /api/2.0/entity-tag-assignments/{entity_type}/{entity_id}/tags/{tag_key}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'entity_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entity_type` from the Databricks SDK endpoint.',
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entity_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/entity-tag-assignments/{entity_type}/{entity_id}/tags/{tag_key}';
    protected const PATH_PARAMS = array (
  'entity_type' => 'entity_type',
  'entity_id' => 'entity_id',
  'tag_key' => 'tag_key',
);
}
