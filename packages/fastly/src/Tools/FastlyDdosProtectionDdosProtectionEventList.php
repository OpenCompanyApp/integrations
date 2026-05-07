<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get events
 *
 * Maps to Fastly generated client operation DdosProtectionApi::ddosProtectionEventList (GET /ddos-protection/v1/events).
 */
class FastlyDdosProtectionDdosProtectionEventList extends AbstractFastlyTool
{
    protected const NAME = 'fastly_ddos_protection_ddos_protection_event_list';
    protected const DESCRIPTION = 'Get events

Official Fastly client operation: DdosProtectionApi::ddosProtectionEventList
Endpoint: GET /ddos-protection/v1/events

Get events';
    protected const PARAMETERS = array (
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
  'service_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'from' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `from`.',
  ),
  'to' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `to`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_ddos_protection_ddos_protection_event_list',
  'class' => 'FastlyDdosProtectionDdosProtectionEventList',
  'api_class' => 'DdosProtectionApi',
  'method_name' => 'ddosProtectionEventList',
  'method' => 'GET',
  'path' => '/ddos-protection/v1/events',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get events',
  'description' => 'Get events',
  'type' => 'read',
  'parameters' =>
  array (
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
    'service_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'from' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `from`.',
    ),
    'to' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `to`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'cursor' => 'cursor',
    'limit' => 'limit',
    'service_id' => 'service_id',
    'from' => 'from',
    'to' => 'to',
    'name' => 'name',
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
