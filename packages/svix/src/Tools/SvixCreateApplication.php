<?php

namespace OpenCompany\Integrations\Svix\Tools;

use OpenCompany\Integrations\Svix\SvixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SvixCreateApplication implements Tool
{
    public function __construct(
        private SvixService $service,
    ) {}

    public function name(): string
    {
        return 'svix_create_application';
    }

    public function description(): string
    {
        return 'Create a new Svix application. Each application represents a webhook sender with its own set of endpoints.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The application name (e.g., "My App").'],
            'uid' => ['type' => 'string', 'description' => 'Optional unique identifier for the application. Must be unique across all applications.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Svix integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('The "name" parameter is required.');
            }

            $uid = $args['uid'] ?? null;
            $result = $this->service->createApplication($name, $uid);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
