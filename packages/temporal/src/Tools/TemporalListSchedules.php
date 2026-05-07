<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List schedules.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/schedules.
 */
class TemporalListSchedules extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_schedules';
    protected const DESCRIPTION = 'List schedules

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/schedules

List all schedules in a namespace.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'The namespace to list schedules in.',
  'required' => true,
),
  'maximum_page_size' => array (
  'type' => 'integer',
  'description' => 'How many to return at once.',
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'Token to get the next page of results.',
),
  'query' => array (
  'type' => 'string',
  'description' => 'Query to filter schedules.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/schedules';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'maximumPageSize' => 'maximum_page_size',
  'nextPageToken' => 'next_page_token',
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
