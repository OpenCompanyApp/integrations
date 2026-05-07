<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Get the authenticated Typefully v2 user.
 *
 * Useful for validating API keys and user context.
 */
class TypefullyGetCurrentUser implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Typefully user profile.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the authenticated Typefully user.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            return ToolResult::success($this->service->getCurrentUser());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
