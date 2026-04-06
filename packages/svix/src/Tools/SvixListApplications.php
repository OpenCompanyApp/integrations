<?php

namespace OpenCompany\Integrations\Svix\Tools;

use OpenCompany\Integrations\Svix\SvixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SvixListApplications implements Tool
{
    public function __construct(
        private SvixService $service,
    ) {}

    public function name(): string
    {
        return 'svix_list_applications';
    }

    public function description(): string
    {
        return 'List all Svix applications. Returns application IDs, names, and UIDs that you can use to manage endpoints and messages.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of applications to return (default: 50, max: 250).'],
            'iterator' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the iterator value from a previous response to get the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Svix integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $iterator = $args['iterator'] ?? null;

            $result = $this->service->listApplications($limit, $iterator);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
