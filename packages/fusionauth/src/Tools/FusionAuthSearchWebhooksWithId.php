<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Webhooks With Id.
 *
 * Maps to POST /api/webhook/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchWebhooksWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_webhooks_with_id',
  'class' => 'FusionAuthSearchWebhooksWithId',
  'method' => 'POST',
  'path' => '/api/webhook/search',
  'operation_id' => 'searchWebhooksWithId',
  'summary' => 'search Webhooks With Id',
  'description' => 'Searches webhooks with the specified criteria and pagination.',
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
