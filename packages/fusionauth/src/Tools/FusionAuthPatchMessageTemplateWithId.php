<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Message Template With Id.
 *
 * Maps to PATCH /api/message/template/{messageTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchMessageTemplateWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_message_template_with_id',
  'class' => 'FusionAuthPatchMessageTemplateWithId',
  'method' => 'PATCH',
  'path' => '/api/message/template/{messageTemplateId}',
  'operation_id' => 'patchMessageTemplateWithId',
  'summary' => 'patch Message Template With Id',
  'description' => 'Updates, via PATCH, the message template with the given Id.',
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
