<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get SAML application metadata.
 *
 * Maps to GET /api/saml-applications/{id}/metadata in the official Logto OpenAPI source.
 */
class LogtoListSamlApplicationMetadata extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_saml_application_metadata',
  'class' => 'LogtoListSamlApplicationMetadata',
  'method' => 'GET',
  'path' => '/api/saml-applications/{id}/metadata',
  'operation_id' => 'ListSamlApplicationMetadata',
  'summary' => 'Get SAML application metadata',
  'description' => 'Get the SAML metadata XML for the application.',
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
