<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get event by ID
 *
 * Maps to Fastly generated client operation DdosProtectionApi::ddosProtectionEventGet (GET /ddos-protection/v1/events/{event_id}).
 */
class FastlyDdosProtectionDdosProtectionEventGet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_ddos_protection_ddos_protection_event_get';
    protected const DESCRIPTION = 'Get event by ID

Official Fastly client operation: DdosProtectionApi::ddosProtectionEventGet
Endpoint: GET /ddos-protection/v1/events/{event_id}

Get event by ID';
    protected const PARAMETERS = array (
  'event_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `event_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_ddos_protection_ddos_protection_event_get',
  'class' => 'FastlyDdosProtectionDdosProtectionEventGet',
  'api_class' => 'DdosProtectionApi',
  'method_name' => 'ddosProtectionEventGet',
  'method' => 'GET',
  'path' => '/ddos-protection/v1/events/{event_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get event by ID',
  'description' => 'Get event by ID',
  'type' => 'read',
  'parameters' =>
  array (
    'event_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `event_id`.',
    ),
  ),
  'path_params' =>
  array (
    'event_id' => 'event_id',
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
