<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby webhook settings. */
class AshbyListWebhooks extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_webhooks';
    protected const DESCRIPTION = 'List Ashby webhook settings.';
    protected const ENDPOINT = '/webhook.list';
    protected const BODY_KEYS = ['cursor', 'syncToken', 'limit'];
    protected const PARAMETERS = [
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
