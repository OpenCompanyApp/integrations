<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Count schedules.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/schedule-count.
 */
class TemporalCountSchedules2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_count_schedules_2';
    protected const DESCRIPTION = 'Count schedules

Official Temporal endpoint: GET /namespaces/{namespace}/schedule-count

CountSchedules is a visibility API to count schedules in a specific namespace.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'query' => array (
  'type' => 'string',
  'description' => 'Visibility query, see https://docs.temporal.io/list-filter for the syntax.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/schedule-count';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
