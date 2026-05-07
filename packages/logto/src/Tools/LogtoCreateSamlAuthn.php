<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Handle SAML authentication request (POST binding).
 *
 * Maps to POST /api/saml/{id}/authn in the official Logto OpenAPI source.
 */
class LogtoCreateSamlAuthn extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_saml_authn',
  'class' => 'LogtoCreateSamlAuthn',
  'method' => 'POST',
  'path' => '/api/saml/{id}/authn',
  'operation_id' => 'CreateSamlAuthn',
  'summary' => 'Handle SAML authentication request (POST binding)',
  'description' => 'Process SAML authentication request using HTTP POST binding.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The ID of the SAML application.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
