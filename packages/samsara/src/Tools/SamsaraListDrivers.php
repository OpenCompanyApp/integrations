<?php

namespace OpenCompany\Integrations\Samsara\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Samsara\SamsaraService;

/**
 * List fleet drivers from Samsara.
 */
class SamsaraListDrivers implements Tool
{
    /**
     * Create a new SamsaraListDrivers tool instance.
     */
    public function __construct(
        private SamsaraService $service,
    ) {}

    /**
     * Get the tool slug identifier.
     */
    public function name(): string
    {
        return 'samsara_list_drivers';
    }

    /**
     * Get the human-readable description of this tool.
     */
    public function description(): string
    {
        return 'List fleet drivers from Samsara. Returns driver details including name, username, email, phone, and driver license info. Supports pagination.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of drivers to return per page (default: 100, max: 512).',
            ],
            'after' => [
                'type' => 'string',
                'description' => 'Pagination cursor - pass the "pagination.endCursor" value from a previous response to fetch the next page.',
            ],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Samsara integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $after = $args['after'] ?? null;

            $result = $this->service->listDrivers($limit, $after);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
