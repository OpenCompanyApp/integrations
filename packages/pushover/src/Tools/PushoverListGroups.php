<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * List Pushover delivery groups owned by the application token's account.
 */
class PushoverListGroups implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_list_groups';
    }

    public function description(): string
    {
        return 'List Pushover delivery groups that the application token can manage.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List delivery groups.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            return ToolResult::success($this->service->listGroups());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
