<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Return local Vero Track API connection status.
 *
 * Vero's Track API does not expose a current-user endpoint, so this tool
 * reports configured status without making a misleading API call.
 */
class VeroGetCurrentUser implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_get_current_user';
    }

    public function description(): string
    {
        return 'Return Vero Track API configuration status. Vero does not expose a current-user endpoint, so API access is verified when write tools run.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
