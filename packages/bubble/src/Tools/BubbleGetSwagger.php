<?php

namespace OpenCompany\Integrations\Bubble\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Bubble\BubbleService;

/**
 * Retrieve the Bubble app Swagger specification.
 *
 * Helps agents discover exposed Data API types and Workflow API endpoints.
 */
class BubbleGetSwagger implements Tool
{
    /**
     * @param  BubbleService  $service  The Bubble API service client
     */
    public function __construct(private BubbleService $service) {}

    public function name(): string
    {
        return 'bubble_get_swagger';
    }

    public function description(): string
    {
        return 'Get the Bubble app Swagger specification for enabled Data API and Workflow API endpoints.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get Swagger metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Bubble integration is not configured.');
            }

            return ToolResult::success($this->service->getSwagger());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
