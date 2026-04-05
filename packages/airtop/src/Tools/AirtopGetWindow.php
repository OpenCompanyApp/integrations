<?php

namespace OpenCompany\Integrations\Airtop\Tools;

use OpenCompany\Integrations\Airtop\AirtopService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AirtopGetWindow implements Tool
{
    public function __construct(
        private AirtopService $service,
    ) {}

    public function name(): string
    {
        return 'airtop_get_window';
    }

    public function description(): string
    {
        return 'Get details of a browser window in an Airtop session, including its current URL and status.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The session ID.'],
            'window_id' => ['type' => 'string', 'required' => true, 'description' => 'The window ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Airtop integration is not configured.');
            }

            $result = $this->service->getWindow($args['session_id'], $args['window_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
