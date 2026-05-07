<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Recent Login.
 *
 * Maps to GET /api/user/recent-login in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserRecentLogin extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_recent_login',
  'class' => 'FusionAuthRetrieveUserRecentLogin',
  'method' => 'GET',
  'path' => '/api/user/recent-login',
  'operation_id' => 'retrieveUserRecentLogin',
  'summary' => 'retrieve User Recent Login',
  'description' => 'Retrieves the last number of login records for a user. OR Retrieves the last number of login records.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The Id of the user.',
    ),
    'offset' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The initial record. e.g. 0 is the last login, 100 will be the 100th most recent login.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => '(Optional, defaults to 10) The number of records to retrieve.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'userId' => 'user_id',
    'offset' => 'offset',
    'limit' => 'limit',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
