<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Consents With Id.
 *
 * Maps to GET /api/user/consent in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserConsentsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_consents_with_id',
  'class' => 'FusionAuthRetrieveUserConsentsWithId',
  'method' => 'GET',
  'path' => '/api/user/consent',
  'operation_id' => 'retrieveUserConsentsWithId',
  'summary' => 'retrieve User Consents With Id',
  'description' => 'Retrieves all the consents for a User.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The User\'s Id',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'userId' => 'user_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
