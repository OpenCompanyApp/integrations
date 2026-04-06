<?php

namespace OpenCompany\Integrations\Clerk\Tools;

use OpenCompany\Integrations\Clerk\ClerkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClerkGetCurrentUser implements Tool
{
    /**
     * Create a new ClerkGetCurrentUser tool instance.
     */
    public function __construct(
        private ClerkService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'clerk_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Health check — verify Clerk API connectivity by fetching the first user. Returns a single user or empty result to confirm the API is reachable.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the health check tool.
     *
     * @param  array  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clerk integration is not configured.');
            }

            $result = $this->service->listUsers(['limit' => 1]);

            return ToolResult::success([
                'connected' => true,
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
