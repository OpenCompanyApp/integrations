<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Form.
 *
 * Maps to POST /api/form in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateForm extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_form',
  'class' => 'FusionAuthCreateForm',
  'method' => 'POST',
  'path' => '/api/form',
  'operation_id' => 'createForm',
  'summary' => 'create Form',
  'description' => 'Creates a form. You can optionally specify an Id for the form, if not provided one will be generated.',
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
