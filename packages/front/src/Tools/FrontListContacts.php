<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List company-level contacts in Front.
 */
class FrontListContacts extends AbstractFrontTool
{
    protected const NAME = 'front_list_contacts';
    protected const DESCRIPTION = 'List and search company-level Front contacts.';
    protected const METHOD = 'GET';
    protected const PATH = '/contacts';
    protected const QUERY_KEYS = ['q', 'limit', 'page_token', 'sort_by', 'sort_order', 'page'];
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'description' => 'Search query object or text. Front supports updated_after and updated_before inside q for contact lists.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort field, such as created_at or updated_at.'],
        'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort order.'],
        'page' => ['type' => 'integer', 'description' => 'Legacy page number for older host usage. Prefer page_token.'],
    ];
}
