<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Returns a list of usage metrics for a specific app for a given time range, grouped by requested time period. This endpoint requires an app management API token. It can be generated in the Your Apps section of Developer Hub. Required scope boards:read Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint GET /v2-experimental/apps/{app_id}/metrics.
 */
class MiroGetMetrics extends AbstractMiroTool
{
    protected const NAME = 'miro_get_metrics';
    protected const DESCRIPTION = 'Returns a list of usage metrics for a specific app for a given time range, grouped by requested time period. This endpoint requires an app management API token. It can be generated in the Your Apps section of Developer Hub. Required scope boards:read Rate limiting Level 1

Official Miro endpoint: GET /v2-experimental/apps/{app_id}/metrics.';
    protected const PARAMETERS = array (
      'app_id' => array (
        'type' => 'string',
        'description' => 'ID of the app to get metrics for.',
        'required' => true,
      ),
      'start_date' => array (
        'type' => 'string',
        'description' => 'Start date of the period in UTC format. For example, 2024-12-31.',
        'required' => true,
      ),
      'end_date' => array (
        'type' => 'string',
        'description' => 'End date of the period in UTC format. For example, 2024-12-31.',
        'required' => true,
      ),
      'period' => array (
        'type' => 'string',
        'description' => 'Group data by this time period.',
        'required' => false,
        'enum' => array (
          'DAY',
          'WEEK',
          'MONTH',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2-experimental/apps/{app_id}/metrics';
    protected const PATH_PARAMS = array (
      'app_id' => 'app_id',
    );
    protected const QUERY_PARAMS = array (
      'startDate' => 'start_date',
      'endDate' => 'end_date',
      'period' => 'period',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
