<?php

namespace OpenCompany\Integrations\Svix\Tools;

use OpenCompany\Integrations\Svix\SvixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SvixGetApplication implements Tool
{
    public function __construct(
        private SvixService $service,
    ) {}

    public function name(): string
    {
        return 'svix_get_application';
    }

    public function description(): string
    {
        return 'Get details of a specific Svix application by its ID, including name, UID, and created timestamp.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The application ID (e.g., "app_xxxxxxxxx").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Svix integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getApplication($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
