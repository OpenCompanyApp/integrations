<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Revoke an Automation Token by ID
 *
 * Maps to Fastly generated client operation AutomationTokensApi::revokeAutomationTokenId (DELETE /automation-tokens/{id}).
 */
class FastlyAutomationTokensRevokeAutomationTokenId extends AbstractFastlyTool
{
    protected const NAME = 'fastly_automation_tokens_revoke_automation_token_id';
    protected const DESCRIPTION = 'Revoke an Automation Token by ID

Official Fastly client operation: AutomationTokensApi::revokeAutomationTokenId
Endpoint: DELETE /automation-tokens/{id}

Revoke an Automation Token by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_automation_tokens_revoke_automation_token_id',
  'class' => 'FastlyAutomationTokensRevokeAutomationTokenId',
  'api_class' => 'AutomationTokensApi',
  'method_name' => 'revokeAutomationTokenId',
  'method' => 'DELETE',
  'path' => '/automation-tokens/{id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Revoke an Automation Token by ID',
  'description' => 'Revoke an Automation Token by ID',
  'type' => 'write',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `id`.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
