<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby candidate/application sources. */
class AshbyListSources extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_sources';
    protected const DESCRIPTION = 'List Ashby sources used for candidates and applications.';
    protected const ENDPOINT = '/source.list';
    protected const BODY_KEYS = ['cursor', 'syncToken', 'limit'];
    protected const PARAMETERS = [
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
