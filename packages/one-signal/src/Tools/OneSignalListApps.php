<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\Integrations\OneSignal\OneSignalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all OneSignal apps accessible with the configured API key.
 *
 * Returns an array of app objects including name, site name,
 * players count, and basic configuration.
 */
class OneSignalListApps implements Tool
{
    /**
     * @param  OneSignalService  $service  OneSignal API client.
     */
    public function __construct(
        private OneSignalService $service,
    ) {}

    public function name(): string
    {
        return 'onesignal_list_apps';
    }

    public function description(): string
    {
        return 'List all OneSignal apps accessible with the configured REST API key. Returns app names, IDs, player counts, and configuration.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneSignal integration is not configured.');
            }

            $result = $this->service->listApps();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
