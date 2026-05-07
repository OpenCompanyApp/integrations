<?php

namespace OpenCompany\Integrations\Heroku\Tools;

use OpenCompany\Integrations\Heroku\HerokuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Heroku apps visible to the authenticated account.
 */
class HerokuListApps implements Tool
{
    /**
     * @param  HerokuService  $service  The Heroku Platform API client.
     */
    public function __construct(
        private HerokuService $service,
    ) {}

    public function name(): string
    {
        return 'heroku_list_apps';
    }

    public function description(): string
    {
        return 'List all Heroku apps the authenticated user has access to. Returns app names, IDs, regions, and status.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List apps available to the authenticated Heroku account.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Heroku integration is not configured.');
            }

            $result = $this->service->listApps();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
