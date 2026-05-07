<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List MailerLite campaigns.
 */
class MailerLiteListCampaigns extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_campaigns';
    }

    public function description(): string
    {
        return 'List campaigns with optional status, type, name, sort, and pagination filters.';
    }

    public function parameters(): array
    {
        return [
            'filter[status]' => ['type' => 'string', 'description' => 'Campaign status filter.'],
            'filter[type]' => ['type' => 'string', 'description' => 'Campaign type filter.'],
            'filter[name]' => ['type' => 'string', 'description' => 'Partial name filter.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field, optionally prefixed with minus for descending order.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
        ];
    }

    /**
     * Execute the campaign listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listCampaigns($this->only($args, [
            'filter[status]', 'filter[type]', 'filter[name]', 'sort', 'page', 'limit',
        ])));
    }
}
