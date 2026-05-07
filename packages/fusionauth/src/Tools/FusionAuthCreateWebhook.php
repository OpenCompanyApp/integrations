<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Webhook.
 *
 * Maps to POST /api/webhook in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateWebhook extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_webhook',
  'class' => 'FusionAuthCreateWebhook',
  'method' => 'POST',
  'path' => '/api/webhook',
  'operation_id' => 'createWebhook',
  'summary' => 'create Webhook',
  'description' => 'Creates a webhook. You can optionally specify an Id for the webhook, if not provided one will be generated.',
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
