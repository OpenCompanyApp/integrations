<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Zoom meeting for a user.
 *
 * Schedules a new meeting with optional settings such as password,
 * waiting room, join-before-host, and approval type.
 */
class ZoomCreateMeeting implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_create_meeting';
    }

    public function description(): string
    {
        return 'Create a Zoom meeting for a user. Supports scheduling with topic, start time, duration, and settings.';
    }

    public function parameters(): array
    {
        return [
            'user_id'    => ['type' => 'string', 'required' => true, 'description' => 'User ID or email address to create the meeting for.'],
            'topic'      => ['type' => 'string', 'required' => true, 'description' => 'Meeting topic / title.'],
            'type'       => ['type' => 'integer', 'description' => 'Meeting type: 1=Instant, 2=Scheduled (default), 3=Recurring no fixed time, 8=Recurring fixed time.'],
            'start_time' => ['type' => 'string', 'description' => 'Meeting start time in ISO 8601 format (e.g., "2024-01-15T10:00:00Z"). Required for scheduled/recurring.'],
            'duration'   => ['type' => 'integer', 'description' => 'Meeting duration in minutes.'],
            'timezone'   => ['type' => 'string', 'description' => 'Timezone for the meeting (e.g., "America/New_York").'],
            'agenda'     => ['type' => 'string', 'description' => 'Meeting description / agenda.'],
            'settings'   => ['type' => 'string', 'description' => 'JSON object of meeting settings (host_video, participant_video, join_before_host, etc.).'],
        ];
    }

    /**
     * Create a meeting for the specified user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id, topic, type, start_time, duration, timezone, agenda, settings)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $userId = $args['user_id'] ?? '';
            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }

            $topic = $args['topic'] ?? '';
            if (empty($topic)) {
                return ToolResult::error('topic is required.');
            }

            $data = ['topic' => $topic];

            if (isset($args['type'])) {
                $data['type'] = (int) $args['type'];
            }
            if (isset($args['start_time'])) {
                $data['start_time'] = $args['start_time'];
            }
            if (isset($args['duration'])) {
                $data['duration'] = (int) $args['duration'];
            }
            if (isset($args['timezone'])) {
                $data['timezone'] = $args['timezone'];
            }
            if (isset($args['agenda'])) {
                $data['agenda'] = $args['agenda'];
            }
            if (isset($args['settings'])) {
                $settings = $args['settings'];
                $data['settings'] = is_string($settings) ? json_decode($settings, true) : $settings;
            }

            $result = $this->service->createMeeting($userId, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'topic' => $result['topic'] ?? $topic,
                'join_url' => $result['join_url'] ?? '',
                'start_url' => $result['start_url'] ?? '',
                'start_time' => $result['start_time'] ?? '',
                'duration' => $result['duration'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
