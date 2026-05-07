<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Webhook With Id.
 *
 * Maps to DELETE /api/webhook/{webhookId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteWebhookWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_webhook_with_id',
  'class' => 'FusionAuthDeleteWebhookWithId',
  'method' => 'DELETE',
  'path' => '/api/webhook/{webhookId}',
  'operation_id' => 'deleteWebhookWithId',
  'summary' => 'delete Webhook With Id',
  'description' => 'Deletes the webhook for the given Id.',
  'parameters' =>
  array (
    'webhook_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the webhook to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
