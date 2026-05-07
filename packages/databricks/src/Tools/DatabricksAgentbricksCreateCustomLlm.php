<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Agentbricks Create Custom Llm.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/custom-llms.
 */
class DatabricksAgentbricksCreateCustomLlm extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_agentbricks_create_custom_llm';
    protected const DESCRIPTION = 'Agentbricks Create Custom Llm

Official Databricks SDK endpoint: POST /api/2.0/custom-llms

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
    protected const PATH = '/api/2.0/custom-llms';
    protected const PATH_PARAMS = array (
);
}
