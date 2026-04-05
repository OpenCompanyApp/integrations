<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DevinGetSession implements Tool
{
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_get_session';
    }

    public function description(): string
    {
        return 'Retrieve details and current status of a Devin session. Use this to check progress on a task, view the session state, or get the output.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Devin session to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $result = $this->service->getSession($args['session_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
