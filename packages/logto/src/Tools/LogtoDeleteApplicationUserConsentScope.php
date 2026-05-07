<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove user consent scope from application.
 *
 * Maps to DELETE /api/applications/{applicationId}/user-consent-scopes/{scopeType}/{scopeId} in the official Logto OpenAPI source.
 */
class LogtoDeleteApplicationUserConsentScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_application_user_consent_scope',
  'class' => 'LogtoDeleteApplicationUserConsentScope',
  'method' => 'DELETE',
  'path' => '/api/applications/{applicationId}/user-consent-scopes/{scopeType}/{scopeId}',
  'operation_id' => 'DeleteApplicationUserConsentScope',
  'summary' => 'Remove user consent scope from application',
  'description' => 'Remove the user consent scope from an application by application id, scope type and scope id',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
    ),
    'scope_type' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Logto path parameter `scopeType`.',
      'enum' =>
      array (
        0 => 'organization-scopes',
        1 => 'resource-scopes',
        2 => 'organization-resource-scopes',
        3 => 'user-scopes',
      ),
    ),
    'scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the scope.',
    ),
  ),
  'path_params' =>
  array (
    'applicationId' => 'application_id',
    'scopeType' => 'scope_type',
    'scopeId' => 'scope_id',
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
