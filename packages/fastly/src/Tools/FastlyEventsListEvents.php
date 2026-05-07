<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List events
 *
 * Maps to Fastly generated client operation EventsApi::listEvents (GET /events).
 */
class FastlyEventsListEvents extends AbstractFastlyTool
{
    protected const NAME = 'fastly_events_list_events';
    protected const DESCRIPTION = 'List events

Official Fastly client operation: EventsApi::listEvents
Endpoint: GET /events

List events';
    protected const PARAMETERS = array (
  'filter_customer_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_customer_id`.',
  ),
  'filter_event_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_event_type`.',
  ),
  'filter_service_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_service_id`.',
  ),
  'filter_user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_user_id`.',
  ),
  'filter_token_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_token_id`.',
  ),
  'filter_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_created_at`.',
  ),
  'filter_created_at_lte' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_created_at_lte`.',
  ),
  'filter_created_at_lt' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_created_at_lt`.',
  ),
  'filter_created_at_gte' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_created_at_gte`.',
  ),
  'filter_created_at_gt' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_created_at_gt`.',
  ),
  'page_number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_number`.',
  ),
  'page_size' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_size`.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sort`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_events_list_events',
  'class' => 'FastlyEventsListEvents',
  'api_class' => 'EventsApi',
  'method_name' => 'listEvents',
  'method' => 'GET',
  'path' => '/events',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List events',
  'description' => 'List events',
  'type' => 'read',
  'parameters' =>
  array (
    'filter_customer_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_customer_id`.',
    ),
    'filter_event_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_event_type`.',
    ),
    'filter_service_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_service_id`.',
    ),
    'filter_user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_user_id`.',
    ),
    'filter_token_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_token_id`.',
    ),
    'filter_created_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_created_at`.',
    ),
    'filter_created_at_lte' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_created_at_lte`.',
    ),
    'filter_created_at_lt' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_created_at_lt`.',
    ),
    'filter_created_at_gte' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_created_at_gte`.',
    ),
    'filter_created_at_gt' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_created_at_gt`.',
    ),
    'page_number' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_number`.',
    ),
    'page_size' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_size`.',
    ),
    'sort' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sort`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'filter[customer_id]' => 'filter_customer_id',
    'filter[event_type]' => 'filter_event_type',
    'filter[service_id]' => 'filter_service_id',
    'filter[user_id]' => 'filter_user_id',
    'filter[token_id]' => 'filter_token_id',
    'filter[created_at]' => 'filter_created_at',
    'filter[created_at][lte]' => 'filter_created_at_lte',
    'filter[created_at][lt]' => 'filter_created_at_lt',
    'filter[created_at][gte]' => 'filter_created_at_gte',
    'filter[created_at][gt]' => 'filter_created_at_gt',
    'page[number]' => 'page_number',
    'page[size]' => 'page_size',
    'sort' => 'sort',
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
