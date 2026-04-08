<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Confluence spaces accessible to the authenticated user.
 */
class ConfluenceGetSpaces implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_get_spaces';
    }

    public function description(): string
    {
        return 'List Confluence spaces accessible to the authenticated user. Supports pagination and filtering by type and status.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results per page. Default: 25.'],
            'start' => ['type' => 'integer', 'description' => 'Start offset for pagination. Default: 0.'],
            'type' => ['type' => 'string', 'description' => 'Space type filter. Example: "global" or "personal".'],
            'status' => ['type' => 'string', 'description' => 'Space status filter. Example: "current" or "archived".'],
        ];
    }

    /**
     * List Confluence spaces with optional pagination and filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, start, type, status)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Confluence is not configured. Missing API token.');
        }

        try {
            $limit = $args['limit'] ?? null;
            $start = $args['start'] ?? null;
            $type = $args['type'] ?? null;
            $status = $args['status'] ?? null;

            $result = $this->service->getSpaces($limit, $start, $type, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
