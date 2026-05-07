<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update SAML application.
 *
 * Maps to PATCH /api/saml-applications/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateSamlApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_saml_application',
  'class' => 'LogtoUpdateSamlApplication',
  'method' => 'PATCH',
  'path' => '/api/saml-applications/{id}',
  'operation_id' => 'UpdateSamlApplication',
  'summary' => 'Update SAML application',
  'description' => 'Update SAML application details by ID.',
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
