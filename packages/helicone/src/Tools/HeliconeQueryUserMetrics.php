<?php

namespace OpenCompany\Integrations\Helicone\Tools;

/**
 * Query Helicone user metrics.
 */
class HeliconeQueryUserMetrics extends AbstractHeliconeTool
{
    protected const NAME = 'helicone_query_user_metrics';
    protected const DESCRIPTION = 'Query Helicone user metrics through POST /v1/user/metrics/query.';
    protected const SERVICE_METHOD = 'queryUserMetrics';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official user metrics query body.'],
    ];
}
