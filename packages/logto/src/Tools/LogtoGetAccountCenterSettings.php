<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get account center settings.
 *
 * Maps to GET /api/account-center in the official Logto OpenAPI source.
 */
class LogtoGetAccountCenterSettings extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_account_center_settings',
  'class' => 'LogtoGetAccountCenterSettings',
  'method' => 'GET',
  'path' => '/api/account-center',
  'operation_id' => 'GetAccountCenterSettings',
  'summary' => 'Get account center settings',
  'description' => 'Get the account center settings.',
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
