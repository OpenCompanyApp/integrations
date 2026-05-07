<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Search Ashby jobs. */
class AshbySearchJobs extends AbstractAshbyTool
{
    protected const NAME = 'ashby_search_jobs';
    protected const DESCRIPTION = 'Search Ashby jobs, including by requisition ID when supported by the account.';
    protected const ENDPOINT = '/job.search';
    protected const BODY_KEYS = ['query', 'requisitionId', 'limit'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'description' => 'Search query.'],
        'requisitionId' => ['type' => 'string', 'description' => 'Job requisition ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
        'body' => ['type' => 'object', 'description' => 'Raw job.search body.'],
    ];
}
