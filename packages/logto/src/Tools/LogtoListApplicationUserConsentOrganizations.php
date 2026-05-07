<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * List all the user consented organizations of a application.
 *
 * Maps to GET /api/applications/{id}/users/{userId}/consent-organizations in the official Logto OpenAPI source.
 */
class LogtoListApplicationUserConsentOrganizations extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_application_user_consent_organizations',
  'class' => 'LogtoListApplicationUserConsentOrganizations',
  'method' => 'GET',
  'path' => '/api/applications/{id}/users/{userId}/consent-organizations',
  'operation_id' => 'ListApplicationUserConsentOrganizations',
  'summary' => 'List all the user consented organizations of a application',
  'description' => 'List all the user consented organizations for a application by application id and user id.',
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
    'page' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Page number (starts from 1).',
    ),
    'page_size' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Entries per page.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'userId' => 'user_id',
  ),
  'query_params' =>
  array (
    'page' => 'page',
    'page_size' => 'page_size',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
