<?php

namespace OpenCompany\Integrations\Paddle\Tools;

use OpenCompany\Integrations\Paddle\PaddleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaddleGetCurrentUser implements Tool
{
    /**
     * Create a new PaddleGetCurrentUser tool instance.
     */
    public function __construct(
        private PaddleService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'paddle_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Verify Paddle API connectivity by performing a health check request. Returns connection status and API response.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paddle integration is not configured.');
            }

            $result = $this->service->healthCheck();

            return ToolResult::success([
                'connected' => true,
                'message' => 'Successfully connected to Paddle API.',
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
