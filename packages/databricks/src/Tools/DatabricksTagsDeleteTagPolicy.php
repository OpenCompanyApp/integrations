<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Tags Delete Tag Policy.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.1/tag-policies/{tag_key}.
 */
class DatabricksTagsDeleteTagPolicy extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_tags_delete_tag_policy';
    protected const DESCRIPTION = 'Tags Delete Tag Policy

Official Databricks SDK endpoint: DELETE /api/2.1/tag-policies/{tag_key}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.1/tag-policies/{tag_key}';
    protected const PATH_PARAMS = array (
  'tag_key' => 'tag_key',
);
}
