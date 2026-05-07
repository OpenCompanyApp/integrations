<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List retrospective metrics.
 *
 * Maps to the official FireHydrant endpoint get /v1/metrics/retrospectives.
 */
class FireHydrantListRetrospectiveMetrics extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_retrospective_metrics';
    protected const DESCRIPTION = 'List retrospective metrics

Official FireHydrant endpoint: GET /v1/metrics/retrospectives

Returns a report with retrospective analytics data';
    protected const PARAMETERS = array (
  'start_date' =>
  array (
    'type' => 'string',
    'description' => 'The start date to return metrics from',
  ),
  'end_date' =>
  array (
    'type' => 'string',
    'description' => 'The end date to return metrics from',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/metrics/retrospectives';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'start_date' => 'start_date',
  'end_date' => 'end_date',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
