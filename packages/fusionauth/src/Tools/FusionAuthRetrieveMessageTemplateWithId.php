<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Message Template With Id.
 *
 * Maps to GET /api/message/template/{messageTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveMessageTemplateWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_message_template_with_id',
  'class' => 'FusionAuthRetrieveMessageTemplateWithId',
  'method' => 'GET',
  'path' => '/api/message/template/{messageTemplateId}',
  'operation_id' => 'retrieveMessageTemplateWithId',
  'summary' => 'retrieve Message Template With Id',
  'description' => 'Retrieves the message template for the given Id. If you don\'t specify the Id, this will return all the message templates.',
  'parameters' =>
  array (
    'message_template_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the message template.',
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
  'type' => 'read',
);
}
