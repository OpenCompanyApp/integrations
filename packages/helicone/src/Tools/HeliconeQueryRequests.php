<?php

namespace OpenCompany\Integrations\Helicone\Tools;

/**
 * Query Helicone request analytics.
 */
class HeliconeQueryRequests extends AbstractHeliconeTool
{
    protected const NAME = 'helicone_query_requests';
    protected const DESCRIPTION = 'Query Helicone request analytics through POST /v1/request/query-clickhouse. Body must match the official filter/sort/limit schema.';
    protected const SERVICE_METHOD = 'queryRequests';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Official request query body.'],
    ];
}
