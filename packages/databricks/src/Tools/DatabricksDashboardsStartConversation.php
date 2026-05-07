<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards Start Conversation.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/genie/spaces/{space_id}/start-conversation.
 */
class DatabricksDashboardsStartConversation extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_start_conversation';
    protected const DESCRIPTION = 'Dashboards Start Conversation

Official Databricks SDK endpoint: POST /api/2.0/genie/spaces/{space_id}/start-conversation

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'space_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `space_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/genie/spaces/{space_id}/start-conversation';
    protected const PATH_PARAMS = array (
  'space_id' => 'space_id',
);
}
