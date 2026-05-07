<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get enabled SSO connectors by the given email's domain.
 *
 * Maps to GET /api/experience/sso-connectors in the official Logto OpenAPI source.
 */
class LogtoGetEnabledSsoConnectors extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_enabled_sso_connectors',
  'class' => 'LogtoGetEnabledSsoConnectors',
  'method' => 'GET',
  'path' => '/api/experience/sso-connectors',
  'operation_id' => 'GetEnabledSsoConnectors',
  'summary' => 'Get enabled SSO connectors by the given email\'s domain',
  'description' => 'Extract the email domain from the provided email address. Returns all the enabled SSO connectors that match the email domain.',
  'parameters' =>
  array (
    'email' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The email address to find the enabled SSO connectors.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'email' => 'email',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
