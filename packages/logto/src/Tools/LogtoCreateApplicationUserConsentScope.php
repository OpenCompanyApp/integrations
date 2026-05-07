<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign user consent scopes to application.
 *
 * Maps to POST /api/applications/{applicationId}/user-consent-scopes in the official Logto OpenAPI source.
 */
class LogtoCreateApplicationUserConsentScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_application_user_consent_scope',
  'class' => 'LogtoCreateApplicationUserConsentScope',
  'method' => 'POST',
  'path' => '/api/applications/{applicationId}/user-consent-scopes',
  'operation_id' => 'CreateApplicationUserConsentScope',
  'summary' => 'Assign user consent scopes to application',
  'description' => 'Assign the user consent scopes to an application by application id',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
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
    'applicationId' => 'application_id',
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
