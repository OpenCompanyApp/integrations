<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Webhook Event Log With Id.
 *
 * Maps to GET /api/system/webhook-event-log/{webhookEventLogId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveWebhookEventLogWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_webhook_event_log_with_id',
  'class' => 'FusionAuthRetrieveWebhookEventLogWithId',
  'method' => 'GET',
  'path' => '/api/system/webhook-event-log/{webhookEventLogId}',
  'operation_id' => 'retrieveWebhookEventLogWithId',
  'summary' => 'retrieve Webhook Event Log With Id',
  'description' => 'Retrieves a single webhook event log for the given Id.',
  'parameters' =>
  array (
    'webhook_event_log_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the webhook event log to retrieve.',
    ),
  ),
  'path_params' =>
  array (
    'webhookEventLogId' => 'webhook_event_log_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
