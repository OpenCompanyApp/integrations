<?php

namespace OpenCompany\Integrations\Helicone\Tools;

/**
 * Query Helicone requests by explicit request IDs.
 */
class HeliconeQueryRequestsByIds extends AbstractHeliconeTool
{
    protected const NAME = 'helicone_query_requests_by_ids';
    protected const DESCRIPTION = 'Retrieve Helicone request rows by IDs through POST /v1/request/query-ids.';
    protected const SERVICE_METHOD = 'queryRequestsByIds';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Body containing requestIds string array.'],
    ];
}
