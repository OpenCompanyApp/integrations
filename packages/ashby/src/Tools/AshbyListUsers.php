<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby users. */
class AshbyListUsers extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_users';
    protected const DESCRIPTION = 'List Ashby users.';
    protected const ENDPOINT = '/user.list';
    protected const BODY_KEYS = ['cursor', 'syncToken', 'limit', 'includeDeactivated'];
    protected const PARAMETERS = [
        'includeDeactivated' => ['type' => 'boolean', 'description' => 'Include deactivated users.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
