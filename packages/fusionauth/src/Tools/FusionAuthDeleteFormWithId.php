<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Form With Id.
 *
 * Maps to DELETE /api/form/{formId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteFormWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_form_with_id',
  'class' => 'FusionAuthDeleteFormWithId',
  'method' => 'DELETE',
  'path' => '/api/form/{formId}',
  'operation_id' => 'deleteFormWithId',
  'summary' => 'delete Form With Id',
  'description' => 'Deletes the form for the given Id.',
  'parameters' =>
  array (
    'form_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the form to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
