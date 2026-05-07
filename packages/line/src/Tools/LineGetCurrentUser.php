<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\Integrations\Line\LineService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get LINE bot information.
 *
 * Retrieves profile details for the LINE Official Account bot.
 */
class LineGetCurrentUser implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(
        private LineService $service,
    ) {}

    public function name(): string
    {
        return 'line_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the LINE Official Account (bot) itself, including display name, icon URL, and basic info.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get bot info.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
