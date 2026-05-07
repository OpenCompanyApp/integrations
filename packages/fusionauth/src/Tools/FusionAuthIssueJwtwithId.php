<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * issue JWTWith Id.
 *
 * Maps to GET /api/jwt/issue in the official FusionAuth OpenAPI document.
 */
class FusionAuthIssueJwtwithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_issue_jwtwith_id',
  'class' => 'FusionAuthIssueJwtwithId',
  'method' => 'GET',
  'path' => '/api/jwt/issue',
  'operation_id' => 'issueJWTWithId',
  'summary' => 'issue JWTWith Id',
  'description' => 'Issue a new access token (JWT) for the requested Application after ensuring the provided JWT is valid. A valid access token is properly signed and not expired. This API may be used in an SSO configuration to issue new tokens for another application after the user has obtained a valid token from authentication.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The Application Id for which you are requesting a new access token be issued.',
    ),
    'refresh_token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'An existing refresh token used to request a refresh token in addition to a JWT in the response. The target application represented by the applicationId request parameter must have refresh tokens enabled in order to receive a refresh token in the response.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'applicationId' => 'application_id',
    'refreshToken' => 'refresh_token',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
