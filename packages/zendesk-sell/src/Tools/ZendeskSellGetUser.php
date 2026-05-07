<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell user.
 */
class ZendeskSellGetUser extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_get_user';
    protected string $toolDescription = 'Get a Zendesk Sell user by ID.';
    protected string $path = '/v2/users/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'User ID.'],
    ];
}
