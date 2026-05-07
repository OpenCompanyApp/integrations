<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Message Template.
 *
 * Maps to POST /api/message/template in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateMessageTemplate extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_message_template',
  'class' => 'FusionAuthCreateMessageTemplate',
  'method' => 'POST',
  'path' => '/api/message/template',
  'operation_id' => 'createMessageTemplate',
  'summary' => 'create Message Template',
  'description' => 'Creates an message template. You can optionally specify an Id for the template, if not provided one will be generated.',
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
