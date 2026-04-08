<?php

namespace OpenCompany\Integrations\Granola\Tools;

use OpenCompany\Integrations\Granola\GranolaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GranolaShareMeeting implements Tool
{
    public function __construct(
        private GranolaService $service,
    ) {}

    public function name(): string
    {
        return 'granola_share_meeting';
    }

    public function description(): string
    {
        return 'Share a Granola meeting with other people. Specify email addresses of recipients and an optional message.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'The meeting ID to share.'],
            'emails' => ['type' => 'array', 'required' => true, 'description' => 'Email addresses of the recipients (e.g., ["alice@example.com", "bob@example.com"]).'],
            'message' => ['type' => 'string', 'description' => 'Optional message to include with the shared meeting.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Granola integration is not configured.');
            }

            if (empty($args['meeting_id'])) {
                return ToolResult::error('Meeting ID is required.');
            }

            if (empty($args['emails']) || !is_array($args['emails'])) {
                return ToolResult::error('At least one email address is required.');
            }

            $data = [
                'emails' => $args['emails'],
            ];

            if (isset($args['message'])) {
                $data['message'] = $args['message'];
            }

            $result = $this->service->shareMeeting($args['meeting_id'], $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
