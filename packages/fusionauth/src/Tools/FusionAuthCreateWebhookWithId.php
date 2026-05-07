<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Webhook With Id.
 *
 * Maps to POST /api/webhook/{webhookId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateWebhookWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_webhook_with_id',
  'class' => 'FusionAuthCreateWebhookWithId',
  'method' => 'POST',
  'path' => '/api/webhook/{webhookId}',
  'operation_id' => 'createWebhookWithId',
  'summary' => 'create Webhook With Id',
  'description' => 'Creates a webhook. You can optionally specify an Id for the webhook, if not provided one will be generated.',
  'parameters' =>
  array (
    'webhook_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the webhook. If not provided a secure random UUID will be generated.',
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
