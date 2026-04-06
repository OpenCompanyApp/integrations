<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

use OpenCompany\Integrations\Bugsnag\BugsnagService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BugsnagGetError implements Tool
{
    public function __construct(
        private BugsnagService $service,
    ) {}

    public function name(): string
    {
        return 'bugsnag_get_error';
    }

    public function description(): string
    {
        return 'Get details for a specific Bugsnag error, including its message, severity, context, and stack trace.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The error ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bugsnag integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('Error ID is required.');
            }

            $result = $this->service->getError($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
