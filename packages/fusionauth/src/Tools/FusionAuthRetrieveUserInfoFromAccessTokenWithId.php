<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Info From Access Token With Id.
 *
 * Maps to GET /oauth2/userinfo in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserInfoFromAccessTokenWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_info_from_access_token_with_id',
  'class' => 'FusionAuthRetrieveUserInfoFromAccessTokenWithId',
  'method' => 'GET',
  'path' => '/oauth2/userinfo',
  'operation_id' => 'retrieveUserInfoFromAccessTokenWithId',
  'summary' => 'retrieve User Info From Access Token With Id',
  'description' => 'Call the UserInfo endpoint to retrieve User Claims from the access token issued by FusionAuth.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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
