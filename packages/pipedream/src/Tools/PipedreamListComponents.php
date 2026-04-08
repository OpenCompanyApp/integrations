<?php

namespace OpenCompany\Integrations\Pipedream\Tools;

use OpenCompany\Integrations\Pipedream\PipedreamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PipedreamListComponents implements Tool
{
    public function __construct(
        private PipedreamService $service,
    ) {}

    public function name(): string
    {
        return 'pipedream_list_components';
    }

    public function description(): string
    {
        return 'List available Pipedream components (actions, triggers, etc.). Components are reusable building blocks for connecting to third-party APIs.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Component type filter. Common values: "action", "trigger". Omit to list all types.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of components to return per page (default: 25, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pipedream integration is not configured.');
            }

            $type = $args['type'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;

            $result = $this->service->listComponents($type, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
