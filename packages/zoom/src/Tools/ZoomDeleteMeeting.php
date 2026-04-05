<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Zoom meeting.
 *
 * Permanently deletes a meeting by its ID.
 */
class ZoomDeleteMeeting implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_delete_meeting';
    }

    public function description(): string
    {
        return 'Delete a Zoom meeting by ID.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'The meeting ID to delete.'],
        ];
    }

    /**
     * Delete a meeting.
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

            $this->service->deleteMeeting($meetingId);

            return ToolResult::success([
                'message' => "Meeting {$meetingId} deleted successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
