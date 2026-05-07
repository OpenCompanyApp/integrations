<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Messenger.
 *
 * Maps to POST /api/messenger in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateMessenger extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_messenger',
  'class' => 'FusionAuthCreateMessenger',
  'method' => 'POST',
  'path' => '/api/messenger',
  'operation_id' => 'createMessenger',
  'summary' => 'create Messenger',
  'description' => 'Creates a messenger. You can optionally specify an Id for the messenger, if not provided one will be generated.',
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
