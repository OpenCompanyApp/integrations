<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby departments or teams. */
class AshbyListDepartments extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_departments';
    protected const DESCRIPTION = 'List Ashby departments/teams used by jobs.';
    protected const ENDPOINT = '/department.list';
    protected const BODY_KEYS = ['cursor', 'syncToken', 'limit'];
    protected const PARAMETERS = [
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
