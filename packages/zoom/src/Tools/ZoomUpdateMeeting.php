<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Zoom meeting.
 *
 * Allows updating topic, start time, duration, and agenda
 * for a scheduled meeting.
 */
class ZoomUpdateMeeting implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_update_meeting';
    }

    public function description(): string
    {
        return 'Update an existing Zoom meeting. Supports changing topic, start time, duration, and agenda.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id'  => ['type' => 'string', 'required' => true, 'description' => 'The meeting ID to update.'],
            'topic'       => ['type' => 'string', 'description' => 'New meeting topic / title.'],
            'start_time'  => ['type' => 'string', 'description' => 'New start time in ISO 8601 format.'],
            'duration'    => ['type' => 'integer', 'description' => 'New duration in minutes.'],
            'agenda'      => ['type' => 'string', 'description' => 'New meeting agenda.'],
        ];
    }

    /**
     * Update a meeting with the provided fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (meeting_id, topic, start_time, duration, agenda)
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

            $data = [];

            if (isset($args['topic'])) {
                $data['topic'] = $args['topic'];
            }
            if (isset($args['start_time'])) {
                $data['start_time'] = $args['start_time'];
            }
            if (isset($args['duration'])) {
                $data['duration'] = (int) $args['duration'];
            }
            if (isset($args['agenda'])) {
                $data['agenda'] = $args['agenda'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update is required (topic, start_time, duration, agenda).');
            }

            $this->service->updateMeeting($meetingId, $data);

            return ToolResult::success([
                'message' => "Meeting {$meetingId} updated successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
