<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a meeting for a user.
 *
 * Returns the created meeting object including id, topic, start_time,
 * duration, join_url, and password.
 */
class ZoomCreateMeeting implements Tool
{
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_create_meeting';
    }

    public function description(): string
    {
        return 'Create a new Zoom meeting. Provide a topic, start time (ISO 8601), duration, and optional timezone. Returns the meeting with join URL and password.';
    }

    public function parameters(): array
    {
        return [
            'topic' => ['type' => 'string', 'required' => true, 'description' => 'Meeting topic/title.'],
            'type' => ['type' => 'string', 'description' => 'Meeting type: "1" = instant, "2" = scheduled (default), "3" = recurring no fixed time, "8" = recurring fixed time.'],
            'start_time' => ['type' => 'string', 'description' => 'Meeting start time in ISO 8601 format (e.g. "2024-01-15T10:00:00Z"). Required for scheduled meetings.'],
            'duration' => ['type' => 'integer', 'description' => 'Meeting duration in minutes. Default: 30.'],
            'timezone' => ['type' => 'string', 'description' => 'Timezone for the meeting (e.g. "America/New_York").'],
            'agenda' => ['type' => 'string', 'description' => 'Meeting description/agenda.'],
            'user_id' => ['type' => 'string', 'description' => 'User ID to create the meeting for. Default: "me".'],
            'settings' => ['type' => 'object', 'description' => 'Meeting settings (join_before_host, mute_upon_entry, etc.).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $topic = $args['topic'] ?? '';

            if (empty($topic)) {
                return ToolResult::error('topic is required.');
            }

            $type = $args['type'] ?? '2';
            $startTime = $args['start_time'] ?? '';
            $duration = isset($args['duration']) ? (int) $args['duration'] : 30;
            $timezone = $args['timezone'] ?? '';
            $userId = $args['user_id'] ?? 'me';

            $options = [];
            if (isset($args['agenda']) && $args['agenda'] !== '') {
                $options['agenda'] = $args['agenda'];
            }
            if (isset($args['settings']) && is_array($args['settings'])) {
                $options['settings'] = $args['settings'];
            }

            $result = $this->service->createMeeting($topic, $type, $startTime, $duration, $timezone, $userId, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
