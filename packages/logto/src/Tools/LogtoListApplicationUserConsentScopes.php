<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * List all the user consent scopes of an application.
 *
 * Maps to GET /api/applications/{applicationId}/user-consent-scopes in the official Logto OpenAPI source.
 */
class LogtoListApplicationUserConsentScopes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_application_user_consent_scopes',
  'class' => 'LogtoListApplicationUserConsentScopes',
  'method' => 'GET',
  'path' => '/api/applications/{applicationId}/user-consent-scopes',
  'operation_id' => 'ListApplicationUserConsentScopes',
  'summary' => 'List all the user consent scopes of an application',
  'description' => 'List all the user consent scopes of an application by application id',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
    ),
  ),
  'path_params' =>
  array (
    'applicationId' => 'application_id',
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
