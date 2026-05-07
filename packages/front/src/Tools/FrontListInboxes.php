<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List Front inboxes accessible to the API token.
 */
class FrontListInboxes extends AbstractFrontTool
{
    protected const NAME = 'front_list_inboxes';
    protected const DESCRIPTION = 'List inboxes accessible by the current Front API token.';
    protected const METHOD = 'GET';
    protected const PATH = '/inboxes';
    protected const QUERY_KEYS = ['limit', 'page_token'];
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
    ];
}
