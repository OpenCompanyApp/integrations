<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\Integrations\Fellow\FellowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Fellow meeting.
 */
class FellowGetMeeting implements Tool
{
    /**
     * Create a new FellowGetMeeting tool instance.
     */
    public function __construct(
        private FellowService $service,
    ) {}

    /**
     * Return the tool's machine name.
     */
    public function name(): string
    {
        return 'fellow_get_meeting';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get full details of a specific Fellow meeting by ID. Returns the meeting title, date, time, duration, attendees, notes, and action items.';
    }

    /**
     * Return the tool's parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'The Fellow meeting UUID.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fellow integration is not configured.');
            }

            $meetingId = $args['meeting_id'] ?? '';

            if (empty($meetingId)) {
                return ToolResult::error('meeting_id is required.');
            }

            $result = $this->service->getMeeting($meetingId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
