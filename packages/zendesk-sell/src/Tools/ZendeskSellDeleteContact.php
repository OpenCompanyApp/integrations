<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Delete a Zendesk Sell contact.
 */
class ZendeskSellDeleteContact extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_delete_contact';
    protected string $toolDescription = 'Delete a Zendesk Sell contact by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v2/contacts/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Contact ID.'],
    ];
}
