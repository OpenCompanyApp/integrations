<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Actioning.
 *
 * Maps to GET /api/user/action in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserActioning extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_actioning',
  'class' => 'FusionAuthRetrieveUserActioning',
  'method' => 'GET',
  'path' => '/api/user/action',
  'operation_id' => 'retrieveUserActioning',
  'summary' => 'retrieve User Actioning',
  'description' => 'Retrieves all the actions for the user with the given Id that are currently inactive. An inactive action means one that is time based and has been canceled or has expired, or is not time based. OR Retrieves all the actions for the user with the given Id that are currently active. An active action means one that is time based and has not been canceled, and has not ended. OR Retrieves all the actions for the user with the given Id that are currently preventing the User from logging in. OR Retrieve',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The Id of the user to fetch the actions for.',
    ),
    'active' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `active`.',
    ),
    'preventing_login' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `preventingLogin`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'userId' => 'user_id',
    'active' => 'active',
    'preventingLogin' => 'preventing_login',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
