<?php

namespace OpenCompany\Integrations\Helicone\Tools;

/**
 * Query Helicone user metrics overview.
 */
class HeliconeQueryUserMetricsOverview extends AbstractHeliconeTool
{
    protected const NAME = 'helicone_query_user_metrics_overview';
    protected const DESCRIPTION = 'Query Helicone user metrics overview through POST /v1/user/metrics-overview/query.';
    protected const SERVICE_METHOD = 'queryUserMetricsOverview';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official user metrics overview query body.'],
    ];
}
