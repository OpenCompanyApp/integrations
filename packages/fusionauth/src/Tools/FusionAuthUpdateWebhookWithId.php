<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Webhook With Id.
 *
 * Maps to PUT /api/webhook/{webhookId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateWebhookWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_webhook_with_id',
  'class' => 'FusionAuthUpdateWebhookWithId',
  'method' => 'PUT',
  'path' => '/api/webhook/{webhookId}',
  'operation_id' => 'updateWebhookWithId',
  'summary' => 'update Webhook With Id',
  'description' => 'Updates the webhook with the given Id.',
  'parameters' =>
  array (
    'webhook_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the webhook to update.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'webhookId' => 'webhook_id',
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
