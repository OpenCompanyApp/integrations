<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Form Field With Id.
 *
 * Maps to PUT /api/form/field/{fieldId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateFormFieldWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_form_field_with_id',
  'class' => 'FusionAuthUpdateFormFieldWithId',
  'method' => 'PUT',
  'path' => '/api/form/field/{fieldId}',
  'operation_id' => 'updateFormFieldWithId',
  'summary' => 'update Form Field With Id',
  'description' => 'Updates the form field with the given Id.',
  'parameters' =>
  array (
    'field_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the form field to update.',
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
    'fieldId' => 'field_id',
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
