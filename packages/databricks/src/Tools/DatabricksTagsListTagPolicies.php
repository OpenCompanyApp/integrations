<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Tags List Tag Policies.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/tag-policies.
 */
class DatabricksTagsListTagPolicies extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_tags_list_tag_policies';
    protected const DESCRIPTION = 'Tags List Tag Policies

Official Databricks SDK endpoint: GET /api/2.1/tag-policies

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.1/tag-policies';
    protected const PATH_PARAMS = array (
);
}
