<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

use OpenCompany\Integrations\Dialpad\DialpadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific call record from Dialpad.
 */
class DialpadGetCall implements Tool
{
    public function __construct(
        private DialpadService $service,
    ) {}

    public function name(): string
    {
        return 'dialpad_get_call';
    }

    public function description(): string
    {
        return 'Get details of a specific call record by ID. Returns full call information including participants, duration, direction, and recording URL if available.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The call history record ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dialpad integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Call ID is required.');
            }

            $result = $this->service->getCall($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
