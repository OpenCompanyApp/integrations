<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create Automation Token
 *
 * Maps to Fastly generated client operation AutomationTokensApi::createAutomationToken (POST /automation-tokens).
 */
class FastlyAutomationTokensCreateAutomationToken extends AbstractFastlyTool
{
    protected const NAME = 'fastly_automation_tokens_create_automation_token';
    protected const DESCRIPTION = 'Create Automation Token

Official Fastly client operation: AutomationTokensApi::createAutomationToken
Endpoint: POST /automation-tokens

Create Automation Token';
    protected const PARAMETERS = array (
  'automation_token_create_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `automation_token_create_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_automation_tokens_create_automation_token',
  'class' => 'FastlyAutomationTokensCreateAutomationToken',
  'api_class' => 'AutomationTokensApi',
  'method_name' => 'createAutomationToken',
  'method' => 'POST',
  'path' => '/automation-tokens',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create Automation Token',
  'description' => 'Create Automation Token',
  'type' => 'write',
  'parameters' =>
  array (
    'automation_token_create_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `automation_token_create_request`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'form_params' =>
  array (
  ),
  'body_param' => 'automation_token_create_request',
  'body_required' => false,
);
}
