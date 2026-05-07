<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List alert events.
 *
 * Maps to the official Rootly endpoint get /v1/alerts/{alert_id}/events.
 */
class RootlyListAlertEvents extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_alert_events';
    protected const DESCRIPTION = 'List alert events

Official Rootly endpoint: GET /v1/alerts/{alert_id}/events

List alert_events';
    protected const PARAMETERS = array (
  'alert_id' =>
  array (
    'type' => 'string',
    'description' => 'alert_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
  'filter_kind' =>
  array (
    'type' => 'string',
    'description' => 'filter[kind] parameter.',
  ),
  'filter_action' =>
  array (
    'type' => 'string',
    'description' => 'filter[action] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alerts/{alert_id}/events';
    protected const PATH_PARAMS = array (
  'alert_id' => 'alert_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[kind]' => 'filter_kind',
  'filter[action]' => 'filter_action',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
