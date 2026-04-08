<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List past meeting instances.
 *
 * Retrieves all past instances of a recurring or previously held meeting.
 */
class ZoomListPastMeetings implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_list_past_meetings';
    }

    public function description(): string
    {
        return 'List past instances of a Zoom meeting.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'The meeting ID to list past instances for.'],
        ];
    }

    /**
     * List past meeting instances.
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

            $result = $this->service->listPastMeetings($meetingId);

            return ToolResult::success([
                'instances' => $result['meetings'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
