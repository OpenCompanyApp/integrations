<?php

namespace OpenCompany\Integrations\Plausible\Tools;

use OpenCompany\Integrations\Plausible\PlausibleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlausibleDeleteSite implements Tool
{
    public function __construct(
        private PlausibleService $service,
    ) {}

    public function name(): string
    {
        return 'plausible_delete_site';
    }

    public function description(): string
    {
        return 'Remove a website from Plausible Analytics tracking. This deletes all associated data.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site domain to delete (e.g., "example.com").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plausible integration is not configured.');
            }

            $this->service->deleteSite($args['site_id']);

            return ToolResult::success("Site '{$args['site_id']}' has been deleted. Data removal may take up to 48 hours.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
