<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a Zoom meeting.
 *
 * Retrieves meeting information including join URL, settings,
 * and participant details by meeting ID.
 */
class ZoomGetMeeting implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_get_meeting';
    }

    public function description(): string
    {
        return 'Get details of a Zoom meeting by ID.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'The meeting ID.'],
        ];
    }

    /**
     * Retrieve a meeting by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (meeting_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
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
