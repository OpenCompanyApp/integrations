<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby openings. */
class AshbyListOpenings extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_openings';
    protected const DESCRIPTION = 'List Ashby job openings.';
    protected const ENDPOINT = '/opening.list';
    protected const BODY_KEYS = ['createdAfter', 'cursor', 'syncToken', 'limit', 'jobId', 'status'];
    protected const PARAMETERS = [
        'jobId' => ['type' => 'string', 'description' => 'Filter by job UUID.'],
        'status' => ['type' => 'string', 'description' => 'Opening status filter.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
