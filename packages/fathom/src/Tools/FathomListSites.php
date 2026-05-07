<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\Integrations\Fathom\FathomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all websites tracked in Fathom Analytics.
 *
 * Returns a paginated list of sites configured in the authenticated Fathom account.
 */
class FathomListSites implements Tool
{
    /**
     * Create a new FathomListSites tool instance.
     *
     * @param  FathomService  $service  The Fathom API service instance.
     */
    public function __construct(
        private FathomService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'fathom_list_sites';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'List all websites tracked in Fathom Analytics. Returns site IDs, names, and domains you can query for analytics data.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of sites to return (default: 20).'],
            'starting_after' => ['type' => 'string', 'description' => 'Cursor for pagination; pass the ID of the last site from a previous response.'],
            'ending_before' => ['type' => 'string', 'description' => 'Cursor for pagination; pass the ID of the first site from a previous response.'],
        ];
    }

    /**
     * Execute the tool and return a list of Fathom sites.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, starting_after, ending_before).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $startingAfter = $args['starting_after'] ?? null;
            $endingBefore = $args['ending_before'] ?? null;

            $result = $this->service->listSites($limit, $startingAfter, $endingBefore);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
