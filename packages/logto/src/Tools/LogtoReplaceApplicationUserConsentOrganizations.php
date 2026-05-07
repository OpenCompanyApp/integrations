<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Grant a list of organization access of a user for a application.
 *
 * Maps to PUT /api/applications/{id}/users/{userId}/consent-organizations in the official Logto OpenAPI source.
 */
class LogtoReplaceApplicationUserConsentOrganizations extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_application_user_consent_organizations',
  'class' => 'LogtoReplaceApplicationUserConsentOrganizations',
  'method' => 'PUT',
  'path' => '/api/applications/{id}/users/{userId}/consent-organizations',
  'operation_id' => 'ReplaceApplicationUserConsentOrganizations',
  'summary' => 'Grant a list of organization access of a user for a application',
  'description' => 'Grant a list of organization access of a user for a application by application id and user id. The user must be a member of all the organizations. Only third-party application needs to be granted access to organizations, all the other applications can request for all the organizations\' access by default.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
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
    'userId' => 'user_id',
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
