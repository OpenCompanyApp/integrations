<?php

namespace OpenCompany\Integrations\Granola\Tools;

use OpenCompany\Integrations\Granola\GranolaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GranolaGetMeeting implements Tool
{
    public function __construct(
        private GranolaService $service,
    ) {}

    public function name(): string
    {
        return 'granola_get_meeting';
    }

    public function description(): string
    {
        return 'Get a single meeting from Granola by ID. Returns the full meeting details including transcript, summary, notes, and participant list.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The meeting ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Granola integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Meeting ID is required.');
            }

            $result = $this->service->getMeeting($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
