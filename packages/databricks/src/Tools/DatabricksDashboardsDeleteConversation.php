<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards Delete Conversation.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/genie/spaces/{space_id}/conversations/{conversation_id}.
 */
class DatabricksDashboardsDeleteConversation extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_delete_conversation';
    protected const DESCRIPTION = 'Dashboards Delete Conversation

Official Databricks SDK endpoint: DELETE /api/2.0/genie/spaces/{space_id}/conversations/{conversation_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'space_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `space_id` from the Databricks SDK endpoint.',
  ),
  'conversation_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `conversation_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/genie/spaces/{space_id}/conversations/{conversation_id}';
    protected const PATH_PARAMS = array (
  'space_id' => 'space_id',
  'conversation_id' => 'conversation_id',
);
}
