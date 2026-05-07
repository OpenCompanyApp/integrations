<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby locations. */
class AshbyListLocations extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_locations';
    protected const DESCRIPTION = 'List Ashby locations used by jobs.';
    protected const ENDPOINT = '/location.list';
    protected const BODY_KEYS = ['cursor', 'syncToken', 'limit'];
    protected const PARAMETERS = [
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
