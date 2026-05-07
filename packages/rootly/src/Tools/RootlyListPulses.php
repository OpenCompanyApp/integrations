<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List pulses.
 *
 * Maps to the official Rootly endpoint get /v1/pulses.
 */
class RootlyListPulses extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_pulses';
    protected const DESCRIPTION = 'List pulses

Official Rootly endpoint: GET /v1/pulses

List pulses';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'filter_source' =>
  array (
    'type' => 'string',
    'description' => 'filter[source] parameter.',
  ),
  'filter_services' =>
  array (
    'type' => 'string',
    'description' => 'filter[services] parameter.',
  ),
  'filter_environments' =>
  array (
    'type' => 'string',
    'description' => 'filter[environments] parameter.',
  ),
  'filter_labels' =>
  array (
    'type' => 'string',
    'description' => 'filter[labels] parameter.',
  ),
  'filter_refs' =>
  array (
    'type' => 'string',
    'description' => 'filter[refs] parameter.',
  ),
  'filter_started_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][gt] parameter.',
  ),
  'filter_started_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][gte] parameter.',
  ),
  'filter_started_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][lt] parameter.',
  ),
  'filter_started_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][lte] parameter.',
  ),
  'filter_ended_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[ended_at][gt] parameter.',
  ),
  'filter_ended_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[ended_at][gte] parameter.',
  ),
  'filter_ended_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[ended_at][lt] parameter.',
  ),
  'filter_ended_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[ended_at][lte] parameter.',
  ),
  'filter_created_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gt] parameter.',
  ),
  'filter_created_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gte] parameter.',
  ),
  'filter_created_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lt] parameter.',
  ),
  'filter_created_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lte] parameter.',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/pulses';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'filter[source]' => 'filter_source',
  'filter[services]' => 'filter_services',
  'filter[environments]' => 'filter_environments',
  'filter[labels]' => 'filter_labels',
  'filter[refs]' => 'filter_refs',
  'filter[started_at][gt]' => 'filter_started_at_gt',
  'filter[started_at][gte]' => 'filter_started_at_gte',
  'filter[started_at][lt]' => 'filter_started_at_lt',
  'filter[started_at][lte]' => 'filter_started_at_lte',
  'filter[ended_at][gt]' => 'filter_ended_at_gt',
  'filter[ended_at][gte]' => 'filter_ended_at_gte',
  'filter[ended_at][lt]' => 'filter_ended_at_lt',
  'filter[ended_at][lte]' => 'filter_ended_at_lte',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
