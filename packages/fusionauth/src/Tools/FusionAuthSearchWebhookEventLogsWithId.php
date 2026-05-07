<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Webhook Event Logs With Id.
 *
 * Maps to POST /api/system/webhook-event-log/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchWebhookEventLogsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_webhook_event_logs_with_id',
  'class' => 'FusionAuthSearchWebhookEventLogsWithId',
  'method' => 'POST',
  'path' => '/api/system/webhook-event-log/search',
  'operation_id' => 'searchWebhookEventLogsWithId',
  'summary' => 'search Webhook Event Logs With Id',
  'description' => 'Searches the webhook event logs with the specified criteria and pagination.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
