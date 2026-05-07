<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * List components on the configured Statuspage page.
 *
 * Supports Statuspage pagination parameters and returns normalized component objects.
 */
class StatuspageListComponents implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_list_components';
    }

    public function description(): string
    {
        return 'List all components on your Atlassian Statuspage. Returns component names, current status, and group information.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of components to return per page.'],
        ];
    }

    /**
     * List Statuspage components with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key and Page ID.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listComponents($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
