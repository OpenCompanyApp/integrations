<?php

namespace OpenCompany\Integrations\Sendy\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sendy\SendyService;

/**
 * List Sendy lists for a brand.
 *
 * Returns the list IDs and names exposed by Sendy's get-lists endpoint.
 */
class SendyGetLists implements Tool
{
    /**
     * @param  SendyService  $service  The Sendy API client
     */
    public function __construct(
        private SendyService $service,
    ) {}

    public function name(): string
    {
        return 'sendy_get_lists';
    }

    public function description(): string
    {
        return 'Get all lists for a Sendy brand, optionally including hidden lists.';
    }

    public function parameters(): array
    {
        return [
            'brand_id' => ['type' => 'string', 'required' => true, 'description' => 'Sendy brand ID.'],
            'include_hidden' => ['type' => 'boolean', 'description' => 'Include hidden lists when true. Defaults to false.'],
        ];
    }

    /**
     * Get lists for a brand.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Sendy integration is not configured.');
            }

            return ToolResult::success($this->service->getLists(
                (string) ($args['brand_id'] ?? ''),
                (bool) ($args['include_hidden'] ?? false),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
