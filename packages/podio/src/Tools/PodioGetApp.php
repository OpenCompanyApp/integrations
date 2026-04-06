<?php

namespace OpenCompany\Integrations\Podio\Tools;

use OpenCompany\Integrations\Podio\PodioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Podio app.
 *
 * Returns full app definition including fields, configuration, and layout.
 * Use this to understand the data structure (fields) of an app before querying items.
 */
class PodioGetApp implements Tool
{
    public function __construct(
        private PodioService $service,
    ) {}

    public function name(): string
    {
        return 'podio_get_app';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Podio app, including its field definitions, layout, and configuration. Use this to understand the data structure before listing or filtering items.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Podio app ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podio integration is not configured.');
            }

            $appId = (int) $args['app_id'];
            $app = $this->service->getApp($appId);

            return ToolResult::success($app);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
