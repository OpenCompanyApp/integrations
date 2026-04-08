<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a meeting by ID.
 *
 * Returns the full meeting object including id, topic, type, start_time,
 * duration, timezone, agenda, settings, and join_url.
 */
class ZoomGetMeeting implements Tool
{
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_get_meeting';
    }

    public function description(): string
    {
        return 'Get details of a specific Zoom meeting by ID. Returns the meeting topic, agenda, start time, duration, join URL, and settings.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'The meeting ID or UUID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $meetingId = $args['meeting_id'] ?? '';

            if (empty($meetingId)) {
                return ToolResult::error('meeting_id is required.');
            }

            $result = $this->service->getMeeting($meetingId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
