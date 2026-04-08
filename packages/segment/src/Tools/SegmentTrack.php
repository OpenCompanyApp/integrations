<?php

namespace OpenCompany\Integrations\Segment\Tools;

use OpenCompany\Integrations\Segment\SegmentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Track an event in Segment.
 *
 * Records actions your users perform, along with optional properties
 * that describe the action.
 */
class SegmentTrack implements Tool
{
    public function __construct(
        private SegmentService $service,
    ) {}

    public function name(): string
    {
        return 'segment_track';
    }

    public function description(): string
    {
        return 'Track a custom event for a user in Segment. Records actions your users perform along with optional properties describing the action.';
    }

    public function parameters(): array
    {
        return [
            'event' => ['type' => 'string', 'required' => true, 'description' => 'The name of the event being tracked (e.g., "Order Completed", "Button Clicked").'],
            'userId' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier for the user in your database.'],
            'properties' => ['type' => 'object', 'description' => 'Key-value pairs of event properties (e.g., revenue, category, productId).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Segment integration is not configured.');
            }

            $result = $this->service->track(
                event: $args['event'],
                userId: $args['userId'],
                properties: $args['properties'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
