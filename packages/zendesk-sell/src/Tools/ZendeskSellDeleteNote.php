<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Delete a Zendesk Sell note.
 */
class ZendeskSellDeleteNote extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_delete_note';
    protected string $toolDescription = 'Delete a Zendesk Sell note by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v2/notes/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Note ID.'],
    ];
}
