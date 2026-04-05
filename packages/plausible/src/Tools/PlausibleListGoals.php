<?php

namespace OpenCompany\Integrations\Plausible\Tools;

use OpenCompany\Integrations\Plausible\PlausibleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlausibleListGoals implements Tool
{
    public function __construct(
        private PlausibleService $service,
    ) {}

    public function name(): string
    {
        return 'plausible_list_goals';
    }

    public function description(): string
    {
        return 'List all goals (conversion tracking) configured for a website in Plausible.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site domain (e.g., "example.com").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plausible integration is not configured.');
            }

            $result = $this->service->listGoals($args['site_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
