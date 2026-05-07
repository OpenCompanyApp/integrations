<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Webex meeting.
 */
class WebexCreateMeeting extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_create_meeting';
    }

    public function description(): string
    {
        return 'Create a Webex meeting with title, start/end times, invitees, and official meeting fields.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Meeting title.'],
            'start' => ['type' => 'string', 'required' => true, 'description' => 'Start time in ISO 8601.'],
            'end' => ['type' => 'string', 'required' => true, 'description' => 'End time in ISO 8601.'],
            'invitees' => ['type' => 'array', 'description' => 'Invitee objects accepted by the Webex API.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official meeting fields.'],
        ];
    }

    /**
     * Create a meeting.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            foreach (['title', 'start', 'end'] as $required) {
                if (empty($args[$required])) {
                    return ToolResult::error($required.' is required.');
                }
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['title', 'start', 'end', 'invitees']));

            return ToolResult::success($this->service->createMeeting($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
