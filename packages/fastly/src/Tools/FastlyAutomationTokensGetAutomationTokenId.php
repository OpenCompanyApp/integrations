<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Retrieve an Automation Token by ID
 *
 * Maps to Fastly generated client operation AutomationTokensApi::getAutomationTokenId (GET /automation-tokens/{id}).
 */
class FastlyAutomationTokensGetAutomationTokenId extends AbstractFastlyTool
{
    protected const NAME = 'fastly_automation_tokens_get_automation_token_id';
    protected const DESCRIPTION = 'Retrieve an Automation Token by ID

Official Fastly client operation: AutomationTokensApi::getAutomationTokenId
Endpoint: GET /automation-tokens/{id}

Retrieve an Automation Token by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_automation_tokens_get_automation_token_id',
  'class' => 'FastlyAutomationTokensGetAutomationTokenId',
  'api_class' => 'AutomationTokensApi',
  'method_name' => 'getAutomationTokenId',
  'method' => 'GET',
  'path' => '/automation-tokens/{id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Retrieve an Automation Token by ID',
  'description' => 'Retrieve an Automation Token by ID',
  'type' => 'read',
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
