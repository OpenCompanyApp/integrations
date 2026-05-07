<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create SAML application secret.
 *
 * Maps to POST /api/saml-applications/{id}/secrets in the official Logto OpenAPI source.
 */
class LogtoCreateSamlApplicationSecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_saml_application_secret',
  'class' => 'LogtoCreateSamlApplicationSecret',
  'method' => 'POST',
  'path' => '/api/saml-applications/{id}/secrets',
  'operation_id' => 'CreateSamlApplicationSecret',
  'summary' => 'Create SAML application secret',
  'description' => 'Create a new signing certificate for the SAML application.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the saml application.',
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
