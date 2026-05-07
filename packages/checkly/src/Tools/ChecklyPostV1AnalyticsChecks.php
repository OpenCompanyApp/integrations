<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Returns availability, response times, and latency metrics for the given checks. Response shape is polymorphic per check type: fields are present only when the metric applies to that type. A null value means no data in the requested time range; an absent field means the metric does not apply to that check type. Currently only quickRange is supported for time filtering. Arbitrary from/to date ranges are not yet supported but may be added in a future release. Rate-limiting is applied to this endpoint, you can send 30 requests / 60 seconds at most..
 *
 * Maps to the official Checkly endpoint POST /v1/analytics/checks.
 */
class ChecklyPostV1AnalyticsChecks extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_analytics_checks';
    protected const DESCRIPTION = 'Returns availability, response times, and latency metrics for the given checks. Response shape is polymorphic per check type: fields are present only when the metric applies to that type. A null value means no data in the requested time range; an absent field means the metric does not apply to that check type. Currently only quickRange is supported for time filtering. Arbitrary from/to date ranges are not yet supported but may be added in a future release. Rate-limiting is applied to this endpoint, you can send 30 requests / 60 seconds at most.

Official Checkly endpoint: POST /v1/analytics/checks.';
    protected const PARAMETERS = array (
      'quick_range' => array (
        'type' => 'string',
        'description' => 'Time range for analytics.',
        'required' => false,
        'enum' => array (
          'last24Hours',
          'last7Days',
          'thisWeek',
          'lastWeek',
          'lastMonth',
        ),
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/analytics/checks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'quickRange' => 'quick_range',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
