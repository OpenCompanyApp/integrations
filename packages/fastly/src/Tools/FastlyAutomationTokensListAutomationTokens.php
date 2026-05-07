<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Customer Automation Tokens
 *
 * Maps to Fastly generated client operation AutomationTokensApi::listAutomationTokens (GET /automation-tokens).
 */
class FastlyAutomationTokensListAutomationTokens extends AbstractFastlyTool
{
    protected const NAME = 'fastly_automation_tokens_list_automation_tokens';
    protected const DESCRIPTION = 'List Customer Automation Tokens

Official Fastly client operation: AutomationTokensApi::listAutomationTokens
Endpoint: GET /automation-tokens

List Customer Automation Tokens';
    protected const PARAMETERS = array (
  'per_page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `per_page`.',
  ),
  'page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_automation_tokens_list_automation_tokens',
  'class' => 'FastlyAutomationTokensListAutomationTokens',
  'api_class' => 'AutomationTokensApi',
  'method_name' => 'listAutomationTokens',
  'method' => 'GET',
  'path' => '/automation-tokens',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Customer Automation Tokens',
  'description' => 'List Customer Automation Tokens',
  'type' => 'read',
  'parameters' =>
  array (
    'per_page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `per_page`.',
    ),
    'page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'per_page' => 'per_page',
    'page' => 'page',
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
