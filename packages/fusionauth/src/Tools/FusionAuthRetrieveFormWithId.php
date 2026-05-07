<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Form With Id.
 *
 * Maps to GET /api/form/{formId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveFormWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_form_with_id',
  'class' => 'FusionAuthRetrieveFormWithId',
  'method' => 'GET',
  'path' => '/api/form/{formId}',
  'operation_id' => 'retrieveFormWithId',
  'summary' => 'retrieve Form With Id',
  'description' => 'Retrieves the form with the given Id.',
  'parameters' =>
  array (
    'form_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the form.',
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
  'type' => 'read',
);
}
