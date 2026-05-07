<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create SAML application.
 *
 * Maps to POST /api/saml-applications in the official Logto OpenAPI source.
 */
class LogtoCreateSamlApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_saml_application',
  'class' => 'LogtoCreateSamlApplication',
  'method' => 'POST',
  'path' => '/api/saml-applications',
  'operation_id' => 'CreateSamlApplication',
  'summary' => 'Create SAML application',
  'description' => 'Create a new SAML application with the given configuration. A default signing certificate with 3 years lifetime will be automatically created.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
