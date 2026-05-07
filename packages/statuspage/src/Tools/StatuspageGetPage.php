<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * Get details for a Statuspage page.
 *
 * Defaults to the configured page but can fetch another visible page by id.
 */
class StatuspageGetPage implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_get_page';
    }

    public function description(): string
    {
        return 'Get details for the configured Atlassian Statuspage page, or a supplied page ID visible to the API key.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'description' => 'Optional page ID. Defaults to the configured Page ID.'],
        ];
    }

    /**
     * Fetch a Statuspage page.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!isset($args['page_id']) && !$this->service->isConfigured()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key and Page ID.');
            }

            if (isset($args['page_id']) && !$this->service->hasApiKey()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key.');
            }

            return ToolResult::success($this->service->getPage($args['page_id'] ?? null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
