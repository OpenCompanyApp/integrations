<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Knowledgeassistants Create Knowledge Assistant.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/knowledge-assistants.
 */
class DatabricksKnowledgeassistantsCreateKnowledgeAssistant extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_knowledgeassistants_create_knowledge_assistant';
    protected const DESCRIPTION = 'Knowledgeassistants Create Knowledge Assistant

Official Databricks SDK endpoint: POST /api/2.1/knowledge-assistants

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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.1/knowledge-assistants';
    protected const PATH_PARAMS = array (
);
}
