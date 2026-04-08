<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Zoom webinar for a user.
 *
 * Schedules a new webinar with topic, start time, duration,
 * and other webinar-specific settings.
 */
class ZoomCreateWebinar implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_create_webinar';
    }

    public function description(): string
    {
        return 'Create a Zoom webinar for a user. Supports scheduling with topic, start time, duration, and timezone.';
    }

    public function parameters(): array
    {
        return [
            'user_id'    => ['type' => 'string', 'required' => true, 'description' => 'User ID or email address to create the webinar for.'],
            'topic'      => ['type' => 'string', 'required' => true, 'description' => 'Webinar topic / title.'],
            'type'       => ['type' => 'integer', 'description' => 'Webinar type: 5=Webinar, 6=Recurring webinar, 9=Recurring webinar no fixed time.'],
            'start_time' => ['type' => 'string', 'description' => 'Webinar start time in ISO 8601 format.'],
            'duration'   => ['type' => 'integer', 'description' => 'Webinar duration in minutes.'],
            'timezone'   => ['type' => 'string', 'description' => 'Timezone for the webinar (e.g., "America/New_York").'],
            'agenda'     => ['type' => 'string', 'description' => 'Webinar description / agenda.'],
        ];
    }

    /**
     * Create a webinar for the specified user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id, topic, type, start_time, duration, timezone, agenda)
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

            $result = $this->service->createWebinar($userId, $data);

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
