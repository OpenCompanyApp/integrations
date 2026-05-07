<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Fellow webhooks.
 */
class FellowListWebhooks extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_list_webhooks';
    }

    public function description(): string
    {
        return 'List Fellow webhooks with optional page size, cursor, and JSON-encoded filters.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page.'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
            'filters' => ['type' => ['string', 'object'], 'description' => 'Webhook filters as JSON string or object.'],
        ];
    }

    /**
     * Execute the list webhooks tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(function () use ($args): array {
            $params = [];

            foreach (['page_size', 'cursor', 'filters'] as $key) {
                if (array_key_exists($key, $args)) {
                    $params[$key] = is_array($args[$key]) ? json_encode($args[$key]) : $args[$key];
                }
            }

            return $this->service->listWebhooks($params);
        });
    }
}
