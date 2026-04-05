<?php

namespace OpenCompany\Integrations\Plausible\Tools;

use OpenCompany\Integrations\Plausible\PlausibleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlausibleCreateSite implements Tool
{
    public function __construct(
        private PlausibleService $service,
    ) {}

    public function name(): string
    {
        return 'plausible_create_site';
    }

    public function description(): string
    {
        return 'Register a new website for tracking in Plausible Analytics.';
    }

    public function parameters(): array
    {
        return [
            'domain' => ['type' => 'string', 'required' => true, 'description' => 'The domain to track (e.g., "example.com").'],
            'timezone' => ['type' => 'string', 'description' => 'Timezone for the site (e.g., "Europe/Amsterdam"). Defaults to "Etc/UTC".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plausible integration is not configured.');
            }

            $timezone = $args['timezone'] ?? 'Etc/UTC';
            $result = $this->service->createSite($args['domain'], $timezone);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
