<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Create a Zendesk Sell note.
 */
class ZendeskSellCreateNote extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_create_note';
    protected string $toolDescription = 'Create a Zendesk Sell note for a lead, contact, or deal.';
    protected string $method = 'POST';
    protected string $path = '/v2/notes';
    protected array $required = ['content', 'resource_type', 'resource_id'];
    protected array $bodyParams = ['content', 'resource_type', 'resource_id', 'is_important', 'tags'];
    protected array $parameters = [
        'content' => ['type' => 'string', 'required' => true, 'description' => 'Note content.'],
        'resource_type' => ['type' => 'string', 'required' => true, 'description' => 'Related resource type such as lead, contact, or deal.'],
        'resource_id' => ['type' => 'integer', 'required' => true, 'description' => 'Related resource ID.'],
        'is_important' => ['type' => 'boolean', 'description' => 'Whether the note is important.'],
        'tags' => ['type' => 'array', 'description' => 'Tags.'],
    ];
}
