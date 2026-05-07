<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get SAML application.
 *
 * Maps to GET /api/saml-applications/{id} in the official Logto OpenAPI source.
 */
class LogtoGetSamlApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_saml_application',
  'class' => 'LogtoGetSamlApplication',
  'method' => 'GET',
  'path' => '/api/saml-applications/{id}',
  'operation_id' => 'GetSamlApplication',
  'summary' => 'Get SAML application',
  'description' => 'Get SAML application details by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the saml application.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
