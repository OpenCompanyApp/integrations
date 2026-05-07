<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Returns total usage metrics for a specific app since the app was created. This endpoint requires an app management API token. It can be generated in your apps section of Developer Hub. Required scope boards:read Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint GET /v2-experimental/apps/{app_id}/metrics-total.
 */
class MiroGetMetricsTotal extends AbstractMiroTool
{
    protected const NAME = 'miro_get_metrics_total';
    protected const DESCRIPTION = 'Returns total usage metrics for a specific app since the app was created. This endpoint requires an app management API token. It can be generated in your apps section of Developer Hub. Required scope boards:read Rate limiting Level 1

Official Miro endpoint: GET /v2-experimental/apps/{app_id}/metrics-total.';
    protected const PARAMETERS = array (
      'app_id' => array (
        'type' => 'string',
        'description' => 'ID of the app to get total metrics for.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2-experimental/apps/{app_id}/metrics-total';
    protected const PATH_PARAMS = array (
      'app_id' => 'app_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
