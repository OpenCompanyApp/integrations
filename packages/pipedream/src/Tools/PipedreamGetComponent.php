<?php

namespace OpenCompany\Integrations\Pipedream\Tools;

use OpenCompany\Integrations\Pipedream\PipedreamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PipedreamGetComponent implements Tool
{
    public function __construct(
        private PipedreamService $service,
    ) {}

    public function name(): string
    {
        return 'pipedream_get_component';
    }

    public function description(): string
    {
        return 'Get details of a specific Pipedream component by app and component key. Returns the component configuration, props, and version info.';
    }

    public function parameters(): array
    {
        return [
            'app' => ['type' => 'string', 'required' => true, 'description' => 'The app slug (e.g., "slack", "github", "google_sheets").'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The component key or ID (e.g., "send-message").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pipedream integration is not configured.');
            }

            if (empty($args['app'])) {
                return ToolResult::error('App slug is required.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Component ID is required.');
            }

            $result = $this->service->getComponent($args['app'], $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
