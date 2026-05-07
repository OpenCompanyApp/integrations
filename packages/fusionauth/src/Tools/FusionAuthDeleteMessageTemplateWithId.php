<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Message Template With Id.
 *
 * Maps to DELETE /api/message/template/{messageTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteMessageTemplateWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_message_template_with_id',
  'class' => 'FusionAuthDeleteMessageTemplateWithId',
  'method' => 'DELETE',
  'path' => '/api/message/template/{messageTemplateId}',
  'operation_id' => 'deleteMessageTemplateWithId',
  'summary' => 'delete Message Template With Id',
  'description' => 'Deletes the message template for the given Id.',
  'parameters' =>
  array (
    'message_template_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the message template to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
