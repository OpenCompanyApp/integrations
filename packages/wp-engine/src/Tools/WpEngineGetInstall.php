<?php

namespace OpenCompany\Integrations\WpEngine\Tools;

use OpenCompany\Integrations\WpEngine\WpEngineService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific WP Engine install.
 *
 * Retrieves full details for a single WordPress install by its ID,
 * including name, environment, PHP version, and status.
 */
class WpEngineGetInstall implements Tool
{
    public function __construct(
        private WpEngineService $service,
    ) {}

    public function name(): string
    {
        return 'wp_engine_get_install';
    }

    public function description(): string
    {
        return 'Get details for a specific WP Engine install by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The install ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WP Engine integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Install ID is required.');
            }

            $result = $this->service->getInstall((string) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
