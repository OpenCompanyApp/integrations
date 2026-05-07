<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get traffic stats for a rule
 *
 * Maps to Fastly generated client operation DdosProtectionApi::ddosProtectionTrafficStatsRuleGet (GET /ddos-protection/v1/events/{event_id}/rules/{rule_id}/traffic-stats).
 */
class FastlyDdosProtectionDdosProtectionTrafficStatsRuleGet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_ddos_protection_ddos_protection_traffic_stats_rule_get';
    protected const DESCRIPTION = 'Get traffic stats for a rule

Official Fastly client operation: DdosProtectionApi::ddosProtectionTrafficStatsRuleGet
Endpoint: GET /ddos-protection/v1/events/{event_id}/rules/{rule_id}/traffic-stats

Get traffic stats for a rule';
    protected const PARAMETERS = array (
  'event_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `event_id`.',
  ),
  'rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `rule_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_ddos_protection_ddos_protection_traffic_stats_rule_get',
  'class' => 'FastlyDdosProtectionDdosProtectionTrafficStatsRuleGet',
  'api_class' => 'DdosProtectionApi',
  'method_name' => 'ddosProtectionTrafficStatsRuleGet',
  'method' => 'GET',
  'path' => '/ddos-protection/v1/events/{event_id}/rules/{rule_id}/traffic-stats',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get traffic stats for a rule',
  'description' => 'Get traffic stats for a rule',
  'type' => 'read',
  'parameters' =>
  array (
    'event_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `event_id`.',
    ),
    'rule_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `rule_id`.',
    ),
  ),
  'path_params' =>
  array (
    'event_id' => 'event_id',
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
