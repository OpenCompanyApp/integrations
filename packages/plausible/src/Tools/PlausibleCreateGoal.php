<?php

namespace OpenCompany\Integrations\Plausible\Tools;

use OpenCompany\Integrations\Plausible\PlausibleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlausibleCreateGoal implements Tool
{
    public function __construct(
        private PlausibleService $service,
    ) {}

    public function name(): string
    {
        return 'plausible_create_goal';
    }

    public function description(): string
    {
        return 'Create a conversion goal for a website in Plausible. Goals can track pageviews to specific pages or custom events.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site domain (e.g., "example.com").'],
            'event_name' => ['type' => 'string', 'description' => 'Custom event name to track (e.g., "Signup"). Use this OR page_path, not both.'],
            'page_path' => ['type' => 'string', 'description' => 'Page path to track visits to (e.g., "/thank-you"). Use this OR event_name, not both.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plausible integration is not configured.');
            }

            $goal = [];
            if (isset($args['event_name'])) {
                $goal['goal_type'] = 'event';
                $goal['event_name'] = $args['event_name'];
            } elseif (isset($args['page_path'])) {
                $goal['goal_type'] = 'page';
                $goal['page_path'] = $args['page_path'];
            } else {
                return ToolResult::error('Either event_name or page_path is required.');
            }

            $result = $this->service->createGoal($args['site_id'], $goal);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
