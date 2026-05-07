<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * SAML application callback.
 *
 * Maps to GET /api/saml-applications/{id}/callback in the official Logto OpenAPI source.
 */
class LogtoGetSamlApplicationCallback extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_saml_application_callback',
  'class' => 'LogtoGetSamlApplicationCallback',
  'method' => 'GET',
  'path' => '/api/saml-applications/{id}/callback',
  'operation_id' => 'GetSamlApplicationCallback',
  'summary' => 'SAML application callback',
  'description' => 'Handle the OIDC callback for SAML application and generate SAML response.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the saml application.',
    ),
    'code' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The authorization code from OIDC callback.',
    ),
    'state' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The state parameter from OIDC callback.',
    ),
    'redirect_uri' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The redirect URI for the callback.',
    ),
    'error' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `error`.',
    ),
    'error_description' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `error_description`.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
    'code' => 'code',
    'state' => 'state',
    'redirectUri' => 'redirect_uri',
    'error' => 'error',
    'error_description' => 'error_description',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
