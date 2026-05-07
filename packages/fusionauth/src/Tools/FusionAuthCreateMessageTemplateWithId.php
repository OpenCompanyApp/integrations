<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Message Template With Id.
 *
 * Maps to POST /api/message/template/{messageTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateMessageTemplateWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_message_template_with_id',
  'class' => 'FusionAuthCreateMessageTemplateWithId',
  'method' => 'POST',
  'path' => '/api/message/template/{messageTemplateId}',
  'operation_id' => 'createMessageTemplateWithId',
  'summary' => 'create Message Template With Id',
  'description' => 'Creates an message template. You can optionally specify an Id for the template, if not provided one will be generated.',
  'parameters' =>
  array (
    'message_template_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the template. If not provided a secure random UUID will be generated.',
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
    'messageTemplateId' => 'message_template_id',
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
