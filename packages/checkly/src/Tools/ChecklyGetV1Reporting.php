<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Generates a report with aggregated statistics for all checks or a filtered set of checks over a specified time window..
 *
 * Maps to the official Checkly endpoint GET /v1/reporting.
 */
class ChecklyGetV1Reporting extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_reporting';
    protected const DESCRIPTION = 'Generates a report with aggregated statistics for all checks or a filtered set of checks over a specified time window.

Official Checkly endpoint: GET /v1/reporting.';
    protected const PARAMETERS = array (
      'from' => array (
        'type' => 'string',
        'description' => 'Custom start time of reporting window in unix timestamp format. Setting a custom "from" timestamp overrides the use of any "quickRange".',
        'required' => false,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Custom end time of reporting window in unix timestamp format. Setting a custom "to" timestamp overrides the use of any "quickRange".',
        'required' => false,
      ),
      'quick_range' => array (
        'type' => 'string',
        'description' => 'Preset reporting windows are used for quickly generating report on commonly used windows. Can be overridden by using a custom "to" and "from" timestamp.',
        'required' => false,
        'enum' => array (
          'last24Hrs',
          'last7Days',
          'last30Days',
          'thisWeek',
          'thisMonth',
          'lastWeek',
          'lastMonth',
        ),
      ),
      'filter_by_tags' => array (
        'type' => 'array',
        'description' => 'Use tags to filter the checks you want to see in your report.',
        'required' => false,
      ),
      'deactivated' => array (
        'type' => 'boolean',
        'description' => 'Filter checks by activated status. When set to true, only deactivated checks are returned. When set to false, only activated checks are returned. When omitted, all checks are returned.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/reporting';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'from' => 'from',
      'to' => 'to',
      'quickRange' => 'quick_range',
      'filterByTags' => 'filter_by_tags',
      'deactivated' => 'deactivated',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
