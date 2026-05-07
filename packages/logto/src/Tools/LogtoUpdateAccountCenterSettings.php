<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update account center settings.
 *
 * Maps to PATCH /api/account-center in the official Logto OpenAPI source.
 */
class LogtoUpdateAccountCenterSettings extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_account_center_settings',
  'class' => 'LogtoUpdateAccountCenterSettings',
  'method' => 'PATCH',
  'path' => '/api/account-center',
  'operation_id' => 'UpdateAccountCenterSettings',
  'summary' => 'Update account center settings',
  'description' => 'Update the account center settings with the provided settings.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
