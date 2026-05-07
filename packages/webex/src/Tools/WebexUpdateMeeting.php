<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Webex meeting.
 */
class WebexUpdateMeeting extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_update_meeting';
    }

    public function description(): string
    {
        return 'Update a Webex meeting by meeting ID.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'Meeting ID.'],
            'title' => ['type' => 'string', 'description' => 'Meeting title.'],
            'start' => ['type' => 'string', 'description' => 'Start time in ISO 8601.'],
            'end' => ['type' => 'string', 'description' => 'End time in ISO 8601.'],
            'invitees' => ['type' => 'array', 'description' => 'Invitee objects accepted by the Webex API.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official meeting fields.'],
        ];
    }

    /**
     * Update a meeting.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['meeting_id'])) {
                return ToolResult::error('meeting_id is required.');
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['title', 'start', 'end', 'invitees']));
            if ($payload === []) {
                return ToolResult::error('At least one update field is required.');
            }

            return ToolResult::success($this->service->updateMeeting((string) $args['meeting_id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
