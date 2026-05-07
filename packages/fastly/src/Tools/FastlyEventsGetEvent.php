<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an event
 *
 * Maps to Fastly generated client operation EventsApi::getEvent (GET /events/{event_id}).
 */
class FastlyEventsGetEvent extends AbstractFastlyTool
{
    protected const NAME = 'fastly_events_get_event';
    protected const DESCRIPTION = 'Get an event

Official Fastly client operation: EventsApi::getEvent
Endpoint: GET /events/{event_id}

Get an event';
    protected const PARAMETERS = array (
  'event_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `event_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_events_get_event',
  'class' => 'FastlyEventsGetEvent',
  'api_class' => 'EventsApi',
  'method_name' => 'getEvent',
  'method' => 'GET',
  'path' => '/events/{event_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an event',
  'description' => 'Get an event',
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
