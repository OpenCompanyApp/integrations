<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * List SAML application secrets.
 *
 * Maps to GET /api/saml-applications/{id}/secrets in the official Logto OpenAPI source.
 */
class LogtoListSamlApplicationSecrets extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_saml_application_secrets',
  'class' => 'LogtoListSamlApplicationSecrets',
  'method' => 'GET',
  'path' => '/api/saml-applications/{id}/secrets',
  'operation_id' => 'ListSamlApplicationSecrets',
  'summary' => 'List SAML application secrets',
  'description' => 'Get all signing certificates of the SAML application.',
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
