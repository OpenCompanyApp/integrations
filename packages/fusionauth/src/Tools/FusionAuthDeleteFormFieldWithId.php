<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Form Field With Id.
 *
 * Maps to DELETE /api/form/field/{fieldId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteFormFieldWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_form_field_with_id',
  'class' => 'FusionAuthDeleteFormFieldWithId',
  'method' => 'DELETE',
  'path' => '/api/form/field/{fieldId}',
  'operation_id' => 'deleteFormFieldWithId',
  'summary' => 'delete Form Field With Id',
  'description' => 'Deletes the form field for the given Id.',
  'parameters' =>
  array (
    'field_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the form field to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
