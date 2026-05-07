<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Count activity executions.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/activity-count.
 */
class TemporalCountActivityExecutions extends AbstractTemporalTool
{
    protected const NAME = 'temporal_count_activity_executions';
    protected const DESCRIPTION = 'Count activity executions

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/activity-count

CountActivityExecutions is a visibility API to count activity executions in a specific namespace.';
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
    protected const PATH = '/api/v1/namespaces/{namespace}/activity-count';
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
