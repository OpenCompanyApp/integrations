<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Automation Token Services
 *
 * Maps to Fastly generated client operation AutomationTokensApi::getAutomationTokensIdServices (GET /automation-tokens/{id}/services).
 */
class FastlyAutomationTokensGetAutomationTokensIdServices extends AbstractFastlyTool
{
    protected const NAME = 'fastly_automation_tokens_get_automation_tokens_id_services';
    protected const DESCRIPTION = 'List Automation Token Services

Official Fastly client operation: AutomationTokensApi::getAutomationTokensIdServices
Endpoint: GET /automation-tokens/{id}/services

List Automation Token Services';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `id`.',
  ),
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
  'slug' => 'fastly_automation_tokens_get_automation_tokens_id_services',
  'class' => 'FastlyAutomationTokensGetAutomationTokensIdServices',
  'api_class' => 'AutomationTokensApi',
  'method_name' => 'getAutomationTokensIdServices',
  'method' => 'GET',
  'path' => '/automation-tokens/{id}/services',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Automation Token Services',
  'description' => 'List Automation Token Services',
  'type' => 'read',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `id`.',
    ),
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
    'id' => 'id',
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
