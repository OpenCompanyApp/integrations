<?php

namespace OpenCompany\Integrations\Modal\Tools;

use OpenCompany\Integrations\Modal\ModalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Modal app.
 */
class ModalGetApp implements Tool
{
    public function __construct(
        private ModalService $service,
    ) {}

    public function name(): string
    {
        return 'modal_get_app';
    }

    public function description(): string
    {
        return 'Get details for a specific Modal app by ID, including status and metadata.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'The ID of the Modal app.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Modal integration is not configured.');
            }

            $appId = $args['app_id'] ?? '';
            if (empty($appId)) {
                return ToolResult::error('The app_id parameter is required.');
            }

            $result = $this->service->getApp($appId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
