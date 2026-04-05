<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\Integrations\Fellow\FellowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated Fellow user profile.
 */
class FellowGetCurrentUser implements Tool
{
    /**
     * Create a new FellowGetCurrentUser tool instance.
     */
    public function __construct(
        private FellowService $service,
    ) {}

    /**
     * Return the tool's machine name.
     */
    public function name(): string
    {
        return 'fellow_get_current_user';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated Fellow user. Returns name, email, and account details.';
    }

    /**
     * Return the tool's parameter schema.
     *
     * @return array<string, array{type: string, description: string}>
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
                return ToolResult::error('Fellow integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
