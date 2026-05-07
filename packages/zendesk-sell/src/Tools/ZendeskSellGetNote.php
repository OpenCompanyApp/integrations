<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell note.
 */
class ZendeskSellGetNote extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_get_note';
    protected string $toolDescription = 'Get a Zendesk Sell note by ID.';
    protected string $path = '/v2/notes/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Note ID.'],
    ];
}
