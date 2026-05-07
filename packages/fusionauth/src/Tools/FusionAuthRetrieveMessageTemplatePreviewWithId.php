<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Message Template Preview With Id.
 *
 * Maps to POST /api/message/template/preview in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveMessageTemplatePreviewWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_message_template_preview_with_id',
  'class' => 'FusionAuthRetrieveMessageTemplatePreviewWithId',
  'method' => 'POST',
  'path' => '/api/message/template/preview',
  'operation_id' => 'retrieveMessageTemplatePreviewWithId',
  'summary' => 'retrieve Message Template Preview With Id',
  'description' => 'Creates a preview of the message template provided in the request, normalized to a given locale.',
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
