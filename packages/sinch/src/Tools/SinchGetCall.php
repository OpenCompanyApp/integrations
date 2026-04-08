<?php

namespace OpenCompany\Integrations\Sinch\Tools;

use OpenCompany\Integrations\Sinch\SinchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SinchGetCall implements Tool
{
    public function __construct(
        private SinchService $service,
    ) {}

    public function name(): string
    {
        return 'sinch_get_call';
    }

    public function description(): string
    {
        return 'Retrieve details of a specific Sinch call record by its ID, including duration, direction, and participants.';
    }

    public function parameters(): array
    {
        return [
            'call_id' => ['type' => 'string', 'required' => true, 'description' => 'The call ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sinch integration is not configured.');
            }

            $result = $this->service->getCall($args['call_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
