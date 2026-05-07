<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete SAML application secret.
 *
 * Maps to DELETE /api/saml-applications/{id}/secrets/{secretId} in the official Logto OpenAPI source.
 */
class LogtoDeleteSamlApplicationSecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_saml_application_secret',
  'class' => 'LogtoDeleteSamlApplicationSecret',
  'method' => 'DELETE',
  'path' => '/api/saml-applications/{id}/secrets/{secretId}',
  'operation_id' => 'DeleteSamlApplicationSecret',
  'summary' => 'Delete SAML application secret',
  'description' => 'Delete a signing certificate of the SAML application. Active certificates cannot be deleted.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
