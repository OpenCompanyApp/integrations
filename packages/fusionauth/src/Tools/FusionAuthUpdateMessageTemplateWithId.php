<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Message Template With Id.
 *
 * Maps to PUT /api/message/template/{messageTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateMessageTemplateWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_message_template_with_id',
  'class' => 'FusionAuthUpdateMessageTemplateWithId',
  'method' => 'PUT',
  'path' => '/api/message/template/{messageTemplateId}',
  'operation_id' => 'updateMessageTemplateWithId',
  'summary' => 'update Message Template With Id',
  'description' => 'Updates the message template with the given Id.',
  'parameters' =>
  array (
    'message_template_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the message template to update.',
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
