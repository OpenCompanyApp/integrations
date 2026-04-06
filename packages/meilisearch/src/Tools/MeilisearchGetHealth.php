<?php

namespace OpenCompany\Integrations\Meilisearch\Tools;

use OpenCompany\Integrations\Meilisearch\MeilisearchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeilisearchGetHealth implements Tool
{
    /**
     * Create a new MeilisearchGetHealth tool instance.
     */
    public function __construct(
        private MeilisearchService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'meilisearch_get_health';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Check the health status of the Meilisearch instance. Returns whether the server is available and operational.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Meilisearch integration is not configured.');
            }

            $result = $this->service->getHealth();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
