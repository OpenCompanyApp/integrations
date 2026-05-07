<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Form With Id.
 *
 * Maps to POST /api/form/{formId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateFormWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_form_with_id',
  'class' => 'FusionAuthCreateFormWithId',
  'method' => 'POST',
  'path' => '/api/form/{formId}',
  'operation_id' => 'createFormWithId',
  'summary' => 'create Form With Id',
  'description' => 'Creates a form. You can optionally specify an Id for the form, if not provided one will be generated.',
  'parameters' =>
  array (
    'form_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the form. If not provided a secure random UUID will be generated.',
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
