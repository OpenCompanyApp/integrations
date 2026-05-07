<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Webhook.
 *
 * Maps to GET /api/webhook in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveWebhook extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_webhook',
  'class' => 'FusionAuthRetrieveWebhook',
  'method' => 'GET',
  'path' => '/api/webhook',
  'operation_id' => 'retrieveWebhook',
  'summary' => 'retrieve Webhook',
  'description' => 'Retrieves the webhook for the given Id. If you pass in null for the Id, this will return all the webhooks.',
  'parameters' =>
  array (
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
  'content_type' => NULL,
  'type' => 'read',
);
}
