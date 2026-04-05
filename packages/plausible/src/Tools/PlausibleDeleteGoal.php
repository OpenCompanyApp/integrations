<?php

namespace OpenCompany\Integrations\Plausible\Tools;

use OpenCompany\Integrations\Plausible\PlausibleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlausibleDeleteGoal implements Tool
{
    public function __construct(
        private PlausibleService $service,
    ) {}

    public function name(): string
    {
        return 'plausible_delete_goal';
    }

    public function description(): string
    {
        return 'Delete a conversion goal from a website in Plausible.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site domain (e.g., "example.com").'],
            'goal_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the goal to delete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plausible integration is not configured.');
            }

            $this->service->deleteGoal($args['site_id'], (int) $args['goal_id']);

            return ToolResult::success("Goal {$args['goal_id']} has been deleted from site '{$args['site_id']}'.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
