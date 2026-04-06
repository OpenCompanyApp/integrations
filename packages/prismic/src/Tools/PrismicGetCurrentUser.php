<?php

namespace OpenCompany\Integrations\Prismic\Tools;

use OpenCompany\Integrations\Prismic\PrismicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PrismicGetCurrentUser implements Tool
{
    /**
     * Create a new PrismicGetCurrentUser tool instance.
     */
    public function __construct(
        private PrismicService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'prismic_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Verify the Prismic API connection is working by performing a minimal document search. Returns connection status and repository information.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the result.
     *
     * Performs a minimal search request (pageSize=1) to verify the API connection
     * is functional and the access token is valid.
     *
     * @param  array  $args  The tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Prismic integration is not configured.');
            }

            $result = $this->service->searchDocuments(['pageSize' => 1]);

            return ToolResult::success([
                'status' => 'connected',
                'total_results_size' => $result['total_results_size'] ?? 0,
                'results_per_page' => $result['results_per_page'] ?? 0,
                'message' => 'Prismic API connection is healthy.',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
