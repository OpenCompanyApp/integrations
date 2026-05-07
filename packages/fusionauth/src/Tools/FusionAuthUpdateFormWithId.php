<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Form With Id.
 *
 * Maps to PUT /api/form/{formId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateFormWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_form_with_id',
  'class' => 'FusionAuthUpdateFormWithId',
  'method' => 'PUT',
  'path' => '/api/form/{formId}',
  'operation_id' => 'updateFormWithId',
  'summary' => 'update Form With Id',
  'description' => 'Updates the form with the given Id.',
  'parameters' =>
  array (
    'form_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the form to update.',
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
    'formId' => 'form_id',
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
