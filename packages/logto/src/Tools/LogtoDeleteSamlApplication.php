<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete SAML application.
 *
 * Maps to DELETE /api/saml-applications/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteSamlApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_saml_application',
  'class' => 'LogtoDeleteSamlApplication',
  'method' => 'DELETE',
  'path' => '/api/saml-applications/{id}',
  'operation_id' => 'DeleteSamlApplication',
  'summary' => 'Delete SAML application',
  'description' => 'Delete a SAML application by ID.',
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
  'type' => 'write',
);
}
