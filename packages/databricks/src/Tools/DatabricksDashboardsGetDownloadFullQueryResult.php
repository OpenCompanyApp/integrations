<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards Get Download Full Query Result.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/genie/spaces/{space_id}/conversations/{conversation_id}/messages/{message_id}/attachments/{attachment_id}/downloads/{download_id}.
 */
class DatabricksDashboardsGetDownloadFullQueryResult extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_get_download_full_query_result';
    protected const DESCRIPTION = 'Dashboards Get Download Full Query Result

Official Databricks SDK endpoint: GET /api/2.0/genie/spaces/{space_id}/conversations/{conversation_id}/messages/{message_id}/attachments/{attachment_id}/downloads/{download_id}

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
  'attachment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `attachment_id` from the Databricks SDK endpoint.',
  ),
  'download_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `download_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/genie/spaces/{space_id}/conversations/{conversation_id}/messages/{message_id}/attachments/{attachment_id}/downloads/{download_id}';
    protected const PATH_PARAMS = array (
  'space_id' => 'space_id',
  'conversation_id' => 'conversation_id',
  'message_id' => 'message_id',
  'attachment_id' => 'attachment_id',
  'download_id' => 'download_id',
);
}
