<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Knowledgeassistants Sync Knowledge Sources.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/{name}/knowledge-sources:sync.
 */
class DatabricksKnowledgeassistantsSyncKnowledgeSources extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_knowledgeassistants_sync_knowledge_sources';
    protected const DESCRIPTION = 'Knowledgeassistants Sync Knowledge Sources

Official Databricks SDK endpoint: POST /api/2.1/{name}/knowledge-sources:sync

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/{name}/knowledge-sources:sync';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
