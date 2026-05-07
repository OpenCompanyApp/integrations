<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards Execute Message Query.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/genie/spaces/{space_id}/conversations/{conversation_id}/messages/{message_id}/execute-query.
 */
class DatabricksDashboardsExecuteMessageQuery extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_execute_message_query';
    protected const DESCRIPTION = 'Dashboards Execute Message Query

Official Databricks SDK endpoint: POST /api/2.0/genie/spaces/{space_id}/conversations/{conversation_id}/messages/{message_id}/execute-query

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
  'message_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `message_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/genie/spaces/{space_id}/conversations/{conversation_id}/messages/{message_id}/execute-query';
    protected const PATH_PARAMS = array (
  'space_id' => 'space_id',
  'conversation_id' => 'conversation_id',
  'message_id' => 'message_id',
);
}
