<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Webhook With Id.
 *
 * Maps to GET /api/webhook/{webhookId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveWebhookWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_webhook_with_id',
  'class' => 'FusionAuthRetrieveWebhookWithId',
  'method' => 'GET',
  'path' => '/api/webhook/{webhookId}',
  'operation_id' => 'retrieveWebhookWithId',
  'summary' => 'retrieve Webhook With Id',
  'description' => 'Retrieves the webhook for the given Id. If you pass in null for the Id, this will return all the webhooks.',
  'parameters' =>
  array (
    'webhook_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the webhook.',
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
  'type' => 'read',
);
}
