<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * List Zendesk Sell notes.
 */
class ZendeskSellListNotes extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_list_notes';
    protected string $toolDescription = 'List Zendesk Sell notes with pagination and resource filters.';
    protected string $path = '/v2/notes';
    protected array $queryParams = ['page', 'per_page', 'sort_by', 'ids', 'resource_type', 'resource_id', 'creator_id'];
    protected array $parameters = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Records per page, max 100.'],
        'resource_type' => ['type' => 'string', 'description' => 'Related resource type such as lead, contact, or deal.'],
        'resource_id' => ['type' => 'integer', 'description' => 'Related resource ID.'],
        'creator_id' => ['type' => 'integer', 'description' => 'Creator user ID.'],
    ];
}
