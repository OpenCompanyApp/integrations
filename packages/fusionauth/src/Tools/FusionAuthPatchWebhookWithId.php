<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Webhook With Id.
 *
 * Maps to PATCH /api/webhook/{webhookId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchWebhookWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_webhook_with_id',
  'class' => 'FusionAuthPatchWebhookWithId',
  'method' => 'PATCH',
  'path' => '/api/webhook/{webhookId}',
  'operation_id' => 'patchWebhookWithId',
  'summary' => 'patch Webhook With Id',
  'description' => 'Patches the webhook with the given Id.',
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
