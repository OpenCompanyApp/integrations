<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Message Template.
 *
 * Maps to GET /api/message/template in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveMessageTemplate extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_message_template',
  'class' => 'FusionAuthRetrieveMessageTemplate',
  'method' => 'GET',
  'path' => '/api/message/template',
  'operation_id' => 'retrieveMessageTemplate',
  'summary' => 'retrieve Message Template',
  'description' => 'Retrieves the message template for the given Id. If you don\'t specify the Id, this will return all the message templates.',
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
