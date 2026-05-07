<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update SAML application secret.
 *
 * Maps to PATCH /api/saml-applications/{id}/secrets/{secretId} in the official Logto OpenAPI source.
 */
class LogtoUpdateSamlApplicationSecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_saml_application_secret',
  'class' => 'LogtoUpdateSamlApplicationSecret',
  'method' => 'PATCH',
  'path' => '/api/saml-applications/{id}/secrets/{secretId}',
  'operation_id' => 'UpdateSamlApplicationSecret',
  'summary' => 'Update SAML application secret',
  'description' => 'Update the status of a signing certificate.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the saml application.',
    ),
    'secret_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the secret.',
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
    'secretId' => 'secret_id',
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
