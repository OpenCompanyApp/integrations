<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Handle SAML authentication request (Redirect binding).
 *
 * Maps to GET /api/saml/{id}/authn in the official Logto OpenAPI source.
 */
class LogtoGetSamlAuthn extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_saml_authn',
  'class' => 'LogtoGetSamlAuthn',
  'method' => 'GET',
  'path' => '/api/saml/{id}/authn',
  'operation_id' => 'GetSamlAuthn',
  'summary' => 'Handle SAML authentication request (Redirect binding)',
  'description' => 'Process SAML authentication request using HTTP Redirect binding.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The ID of the SAML application.',
    ),
    'samlrequest' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The SAML request message.',
    ),
    'signature' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The signature of the request.',
    ),
    'sig_alg' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The signature algorithm.',
    ),
    'relay_state' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The relay state parameter.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
    'SAMLRequest' => 'samlrequest',
    'Signature' => 'signature',
    'SigAlg' => 'sig_alg',
    'RelayState' => 'relay_state',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
