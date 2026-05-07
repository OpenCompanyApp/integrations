<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Form Field With Id.
 *
 * Maps to GET /api/form/field/{fieldId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveFormFieldWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_form_field_with_id',
  'class' => 'FusionAuthRetrieveFormFieldWithId',
  'method' => 'GET',
  'path' => '/api/form/field/{fieldId}',
  'operation_id' => 'retrieveFormFieldWithId',
  'summary' => 'retrieve Form Field With Id',
  'description' => 'Retrieves the form field with the given Id.',
  'parameters' =>
  array (
    'field_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the form field.',
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
  'type' => 'read',
);
}
