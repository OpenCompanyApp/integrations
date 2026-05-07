<?php

namespace OpenCompany\Integrations\ServiceM8\Tools;

use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List staff visible to the authenticated ServiceM8 token.
 *
 * ServiceM8's public API exposes staff records rather than a dedicated /me
 * endpoint, so this tool returns the staff collection.
 */
class ServiceM8GetCurrentUser implements Tool
{
    public function __construct(
        private ServiceM8Service $service,
    ) {}

    public function name(): string
    {
        return 'servicem8_get_current_user';
    }

    public function description(): string
    {
        return 'List staff members visible to the authenticated ServiceM8 token. ServiceM8 does not expose a dedicated /me endpoint in the public API.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ServiceM8 integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
