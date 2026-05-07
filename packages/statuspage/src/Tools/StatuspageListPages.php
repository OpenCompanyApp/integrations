<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * List Statuspage pages visible to the authenticated API key.
 *
 * Useful for finding the page_id needed by page-scoped tools.
 */
class StatuspageListPages implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_list_pages';
    }

    public function description(): string
    {
        return 'List Atlassian Statuspage pages available to the authenticated API key. Use this to discover page IDs.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of pages to return per page.'],
        ];
    }

    /**
     * List pages using optional pagination arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->hasApiKey()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            return ToolResult::success($this->service->listPages($params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
