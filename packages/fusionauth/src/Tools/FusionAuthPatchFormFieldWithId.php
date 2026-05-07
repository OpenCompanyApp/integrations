<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Form Field With Id.
 *
 * Maps to PATCH /api/form/field/{fieldId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchFormFieldWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_form_field_with_id',
  'class' => 'FusionAuthPatchFormFieldWithId',
  'method' => 'PATCH',
  'path' => '/api/form/field/{fieldId}',
  'operation_id' => 'patchFormFieldWithId',
  'summary' => 'patch Form Field With Id',
  'description' => 'Patches the form field with the given Id.',
  'parameters' =>
  array (
    'field_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the form field to patch.',
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
