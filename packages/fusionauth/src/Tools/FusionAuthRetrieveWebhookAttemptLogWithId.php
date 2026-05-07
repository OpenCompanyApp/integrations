<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Webhook Attempt Log With Id.
 *
 * Maps to GET /api/system/webhook-attempt-log/{webhookAttemptLogId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveWebhookAttemptLogWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_webhook_attempt_log_with_id',
  'class' => 'FusionAuthRetrieveWebhookAttemptLogWithId',
  'method' => 'GET',
  'path' => '/api/system/webhook-attempt-log/{webhookAttemptLogId}',
  'operation_id' => 'retrieveWebhookAttemptLogWithId',
  'summary' => 'retrieve Webhook Attempt Log With Id',
  'description' => 'Retrieves a single webhook attempt log for the given Id.',
  'parameters' =>
  array (
    'webhook_attempt_log_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the webhook attempt log to retrieve.',
    ),
  ),
  'path_params' =>
  array (
    'webhookAttemptLogId' => 'webhook_attempt_log_id',
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
