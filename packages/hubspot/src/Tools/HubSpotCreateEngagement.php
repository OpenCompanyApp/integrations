<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an engagement (note, task, or meeting) in HubSpot CRM.
 *
 * Supports creating notes, tasks, and meetings with body content, timestamps, and owner assignment.
 */
class HubSpotCreateEngagement implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_create_engagement';
    }

    public function description(): string
    {
        return <<<'MD'
        Create an engagement in HubSpot CRM (note, task, or meeting).
        Specify the type and provide the relevant properties.
        For notes: body (HTML content). For tasks: hs_task_body, hs_task_subject, hs_task_status.
        For meetings: hs_meeting_title, hs_meeting_body, hs_meeting_start_time, hs_meeting_end_time.
        MD;
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Engagement type: "notes", "tasks", or "meetings".'],
            'body' => ['type' => 'string', 'description' => 'Engagement body content (HTML for notes, plain text for tasks).'],
            'timestamp' => ['type' => 'string', 'description' => 'Engagement timestamp in ISO 8601 format.'],
            'owner_id' => ['type' => 'string', 'description' => 'HubSpot owner ID to assign the engagement to.'],
            'properties' => ['type' => 'object', 'description' => 'Additional custom properties as key-value pairs.'],
        ];
    }

    /**
     * Create a HubSpot engagement (note, task, or meeting).
     *
     * @param  array<string, mixed>  $args  Tool arguments (type, body, timestamp, owner_id, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $type = $args['type'] ?? '';
            if (empty($type) || ! in_array($type, ['notes', 'tasks', 'meetings'], true)) {
                return ToolResult::error('type must be one of: "notes", "tasks", "meetings".');
            }

            $properties = [];

            if (! empty($args['body'])) {
                if ($type === 'notes') {
                    $properties['hs_note_body'] = $args['body'];
                } elseif ($type === 'tasks') {
                    $properties['hs_task_body'] = $args['body'];
                } elseif ($type === 'meetings') {
                    $properties['hs_meeting_body'] = $args['body'];
                }
            }

            if (! empty($args['timestamp'])) {
                $properties['hs_timestamp'] = $args['timestamp'];
            }

            if (! empty($args['owner_id'])) {
                $properties['hubspot_owner_id'] = $args['owner_id'];
            }

            if (isset($args['properties']) && is_array($args['properties'])) {
                foreach ($args['properties'] as $key => $value) {
                    $properties[$key] = $value;
                }
            }

            $result = $this->service->createEngagement($type, $properties);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'type' => $type,
                'properties' => $result['properties'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
