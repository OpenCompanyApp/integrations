<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Confluence space.
 */
class ConfluenceGetSpace implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_get_space';
    }

    public function description(): string
    {
        return 'Get details for a specific Confluence space by its key.';
    }

    public function parameters(): array
    {
        return [
            'space_key' => ['type' => 'string', 'required' => true, 'description' => 'The space key (e.g. "DEV").'],
        ];
    }

    /**
     * Retrieve a Confluence space by its key.
     *
     * @param  array<string, mixed>  $args  Tool arguments (space_key)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Confluence is not configured. Missing API token.');
        }

        $spaceKey = $args['space_key'] ?? '';

        if (empty($spaceKey)) {
            return ToolResult::error('Space key is required.');
        }

        try {
            $result = $this->service->getSpace($spaceKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
