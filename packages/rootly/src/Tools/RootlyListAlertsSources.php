<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List alert sources.
 *
 * Maps to the official Rootly endpoint get /v1/alert_sources.
 */
class RootlyListAlertsSources extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_alerts_sources';
    protected const DESCRIPTION = 'List alert sources

Official Rootly endpoint: GET /v1/alert_sources

List alert sources';
    protected const PARAMETERS = array (
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
  'filter_search' =>
  array (
    'type' => 'string',
    'description' => 'filter[search] parameter.',
  ),
  'filter_statuses' =>
  array (
    'type' => 'string',
    'description' => 'filter[statuses] parameter.',
  ),
  'filter_source_types' =>
  array (
    'type' => 'string',
    'description' => 'filter[source_types] parameter.',
  ),
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'filter[name] parameter.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alert_sources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[statuses]' => 'filter_statuses',
  'filter[source_types]' => 'filter_source_types',
  'filter[name]' => 'filter_name',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
