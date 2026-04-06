<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SquareListLocations implements Tool
{
    /**
     * Create a new SquareListLocations tool instance.
     */
    public function __construct(
        private SquareService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'square_list_locations';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all business locations configured in Square, including name, address, and status.';
    }

    /**
     * Get the tool parameter definitions.
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
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $result = $this->service->listLocations();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
