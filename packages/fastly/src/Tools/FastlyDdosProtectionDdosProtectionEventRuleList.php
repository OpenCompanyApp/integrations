<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get all rules for an event
 *
 * Maps to Fastly generated client operation DdosProtectionApi::ddosProtectionEventRuleList (GET /ddos-protection/v1/events/{event_id}/rules).
 */
class FastlyDdosProtectionDdosProtectionEventRuleList extends AbstractFastlyTool
{
    protected const NAME = 'fastly_ddos_protection_ddos_protection_event_rule_list';
    protected const DESCRIPTION = 'Get all rules for an event

Official Fastly client operation: DdosProtectionApi::ddosProtectionEventRuleList
Endpoint: GET /ddos-protection/v1/events/{event_id}/rules

Get all rules for an event';
    protected const PARAMETERS = array (
  'event_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `event_id`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `include`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_ddos_protection_ddos_protection_event_rule_list',
  'class' => 'FastlyDdosProtectionDdosProtectionEventRuleList',
  'api_class' => 'DdosProtectionApi',
  'method_name' => 'ddosProtectionEventRuleList',
  'method' => 'GET',
  'path' => '/ddos-protection/v1/events/{event_id}/rules',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get all rules for an event',
  'description' => 'Get all rules for an event',
  'type' => 'read',
  'parameters' =>
  array (
    'event_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `event_id`.',
    ),
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'include' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `include`.',
    ),
  ),
  'path_params' =>
  array (
    'event_id' => 'event_id',
  ),
  'query_params' =>
  array (
    'cursor' => 'cursor',
    'limit' => 'limit',
    'include' => 'include',
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
