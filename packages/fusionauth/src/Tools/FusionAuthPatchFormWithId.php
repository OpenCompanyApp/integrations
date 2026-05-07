<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Form With Id.
 *
 * Maps to PATCH /api/form/{formId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchFormWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_form_with_id',
  'class' => 'FusionAuthPatchFormWithId',
  'method' => 'PATCH',
  'path' => '/api/form/{formId}',
  'operation_id' => 'patchFormWithId',
  'summary' => 'patch Form With Id',
  'description' => 'Patches the form with the given Id.',
  'parameters' =>
  array (
    'form_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the form to patch.',
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
