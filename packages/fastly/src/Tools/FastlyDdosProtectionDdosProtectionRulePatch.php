<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update rule
 *
 * Maps to Fastly generated client operation DdosProtectionApi::ddosProtectionRulePatch (PATCH /ddos-protection/v1/rules/{rule_id}).
 */
class FastlyDdosProtectionDdosProtectionRulePatch extends AbstractFastlyTool
{
    protected const NAME = 'fastly_ddos_protection_ddos_protection_rule_patch';
    protected const DESCRIPTION = 'Update rule

Official Fastly client operation: DdosProtectionApi::ddosProtectionRulePatch
Endpoint: PATCH /ddos-protection/v1/rules/{rule_id}

Update rule';
    protected const PARAMETERS = array (
  'rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `rule_id`.',
  ),
  'ddos_protection_rule_patch' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `ddos_protection_rule_patch`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_ddos_protection_ddos_protection_rule_patch',
  'class' => 'FastlyDdosProtectionDdosProtectionRulePatch',
  'api_class' => 'DdosProtectionApi',
  'method_name' => 'ddosProtectionRulePatch',
  'method' => 'PATCH',
  'path' => '/ddos-protection/v1/rules/{rule_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update rule',
  'description' => 'Update rule',
  'type' => 'write',
  'parameters' =>
  array (
    'rule_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `rule_id`.',
    ),
    'ddos_protection_rule_patch' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `ddos_protection_rule_patch`.',
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
    'rule_id' => 'rule_id',
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
  'body_param' => 'ddos_protection_rule_patch',
  'body_required' => false,
);
}
