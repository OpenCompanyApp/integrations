<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Webex meeting.
 */
class WebexDeleteMeeting extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_delete_meeting';
    }

    public function description(): string
    {
        return 'Delete a Webex meeting by meeting ID.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'Meeting ID.'],
        ];
    }

    /**
     * Delete a meeting.
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

            return ToolResult::success($this->service->deleteMeeting((string) $args['meeting_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
