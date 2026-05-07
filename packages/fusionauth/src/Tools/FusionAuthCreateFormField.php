<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Form Field.
 *
 * Maps to POST /api/form/field in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateFormField extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_form_field',
  'class' => 'FusionAuthCreateFormField',
  'method' => 'POST',
  'path' => '/api/form/field',
  'operation_id' => 'createFormField',
  'summary' => 'create Form Field',
  'description' => 'Creates a form field. You can optionally specify an Id for the form, if not provided one will be generated.',
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
