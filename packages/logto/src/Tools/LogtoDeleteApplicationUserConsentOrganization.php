<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Revoke a user's access to an organization for a application.
 *
 * Maps to DELETE /api/applications/{id}/users/{userId}/consent-organizations/{organizationId} in the official Logto OpenAPI source.
 */
class LogtoDeleteApplicationUserConsentOrganization extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_application_user_consent_organization',
  'class' => 'LogtoDeleteApplicationUserConsentOrganization',
  'method' => 'DELETE',
  'path' => '/api/applications/{id}/users/{userId}/consent-organizations/{organizationId}',
  'operation_id' => 'DeleteApplicationUserConsentOrganization',
  'summary' => 'Revoke a user\'s access to an organization for a application',
  'description' => 'Revoke a user\'s access to an organization for a application by application id, user id and organization id.',
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
    'organization_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'userId' => 'user_id',
    'organizationId' => 'organization_id',
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
