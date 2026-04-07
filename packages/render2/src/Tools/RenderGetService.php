<?php

namespace OpenCompany\Integrations\Render2\Tools;

use OpenCompany\Integrations\Render2\RenderService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderGetService implements Tool
{
    public function __construct(
        private RenderService $service,
    ) {}

    public function name(): string
    {
        return 'render_get_service';
    }

    public function description(): string
    {
        return 'Get details for a specific Render service by ID. Returns full service information including type, status, URLs, and configuration.';
    }

    public function parameters(): array
    {
        return [
            'service_id' => ['type' => 'string', 'required' => true, 'description' => 'The service ID (e.g., "srv-cabc12345678").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Render integration is not configured.');
            }

            $result = $this->service->getService($args['service_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
