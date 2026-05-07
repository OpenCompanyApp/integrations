<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Form Field With Id.
 *
 * Maps to POST /api/form/field/{fieldId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateFormFieldWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_form_field_with_id',
  'class' => 'FusionAuthCreateFormFieldWithId',
  'method' => 'POST',
  'path' => '/api/form/field/{fieldId}',
  'operation_id' => 'createFormFieldWithId',
  'summary' => 'create Form Field With Id',
  'description' => 'Creates a form field. You can optionally specify an Id for the form, if not provided one will be generated.',
  'parameters' =>
  array (
    'field_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the form field. If not provided a secure random UUID will be generated.',
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
