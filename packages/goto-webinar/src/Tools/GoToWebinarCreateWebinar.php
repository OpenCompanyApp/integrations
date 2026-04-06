<?php

namespace OpenCompany\Integrations\GoToWebinar\Tools;

use OpenCompany\Integrations\GoToWebinar\GoToWebinarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoToWebinarCreateWebinar implements Tool
{
    public function __construct(
        private GoToWebinarService $service,
    ) {}

    public function name(): string
    {
        return 'gotowebinar_create_webinar';
    }

    public function description(): string
    {
        return 'Schedule a new webinar in GoTo Webinar. Provide a subject, one or more time slots (each with startTime and endTime in ISO 8601 format), and an optional description.';
    }

    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The webinar subject/title.'],
            'times' => ['type' => 'array', 'required' => true, 'description' => 'Array of time slots. Each slot must have "startTime" and "endTime" in ISO 8601 format (e.g., "2026-04-10T15:00:00Z").'],
            'description' => ['type' => 'string', 'description' => 'Optional description of the webinar.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GoTo Webinar integration is not configured.');
            }

            if (empty($args['subject'])) {
                return ToolResult::error('The webinar subject is required.');
            }

            if (empty($args['times']) || !is_array($args['times'])) {
                return ToolResult::error('At least one time slot is required. Each slot must have "startTime" and "endTime".');
            }

            // Validate each time slot has required fields
            foreach ($args['times'] as $i => $time) {
                if (!is_array($time)) {
                    return ToolResult::error("Time slot at index {$i} must be an object with startTime and endTime.");
                }
                if (empty($time['startTime']) || empty($time['endTime'])) {
                    return ToolResult::error("Time slot at index {$i} is missing startTime or endTime.");
                }
            }

            $result = $this->service->createWebinar(
                subject: $args['subject'],
                times: $args['times'],
                description: $args['description'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
