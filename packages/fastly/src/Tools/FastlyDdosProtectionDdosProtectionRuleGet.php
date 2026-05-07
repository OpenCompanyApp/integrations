<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a rule by ID
 *
 * Maps to Fastly generated client operation DdosProtectionApi::ddosProtectionRuleGet (GET /ddos-protection/v1/rules/{rule_id}).
 */
class FastlyDdosProtectionDdosProtectionRuleGet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_ddos_protection_ddos_protection_rule_get';
    protected const DESCRIPTION = 'Get a rule by ID

Official Fastly client operation: DdosProtectionApi::ddosProtectionRuleGet
Endpoint: GET /ddos-protection/v1/rules/{rule_id}

Get a rule by ID';
    protected const PARAMETERS = array (
  'rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `rule_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_ddos_protection_ddos_protection_rule_get',
  'class' => 'FastlyDdosProtectionDdosProtectionRuleGet',
  'api_class' => 'DdosProtectionApi',
  'method_name' => 'ddosProtectionRuleGet',
  'method' => 'GET',
  'path' => '/ddos-protection/v1/rules/{rule_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a rule by ID',
  'description' => 'Get a rule by ID',
  'type' => 'read',
  'parameters' =>
  array (
    'rule_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `rule_id`.',
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
  'body_param' => NULL,
  'body_required' => false,
);
}
