<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshsalesGetCurrentUser implements Tool
{
    /**
     * Create a new FreshsalesGetCurrentUser tool instance.
     */
    public function __construct(
        private FreshsalesService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshsales_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get details of the currently authenticated Freshsales user. Useful for verifying the connection and identifying which user context the integration is operating under.';
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
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
