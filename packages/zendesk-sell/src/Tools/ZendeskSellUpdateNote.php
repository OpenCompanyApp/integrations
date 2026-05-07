<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Update a Zendesk Sell note.
 */
class ZendeskSellUpdateNote extends ZendeskSellCreateNote
{
    protected string $toolName = 'zendesk_sell_update_note';
    protected string $toolDescription = 'Update a Zendesk Sell note by ID.';
    protected string $method = 'PUT';
    protected string $path = '/v2/notes/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Note ID.'],
        'content' => ['type' => 'string', 'description' => 'Note content.'],
        'is_important' => ['type' => 'boolean', 'description' => 'Whether the note is important.'],
        'tags' => ['type' => 'array', 'description' => 'Complete tag set for the note.'],
    ];
}
