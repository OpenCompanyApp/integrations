<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get MFA verifications.
 *
 * Maps to GET /api/my-account/mfa-verifications in the official Logto OpenAPI source.
 */
class LogtoGetMfaVerifications extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_mfa_verifications',
  'class' => 'LogtoGetMfaVerifications',
  'method' => 'GET',
  'path' => '/api/my-account/mfa-verifications',
  'operation_id' => 'GetMfaVerifications',
  'summary' => 'Get MFA verifications',
  'description' => 'Get MFA verifications for the user.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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
