<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Get current visitors for a Fathom site.
 */
class FathomGetCurrentVisitors implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_get_current_visitors';
    }

    public function description(): string
    {
        return 'Get the current visitor count for a Fathom site, optionally with top pages and referrers.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'detailed' => ['type' => 'boolean', 'description' => 'When true, include top pages and referrers.'],
        ];
    }

    /**
     * Get current visitors.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, detailed).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }
            if (empty($args['site_id'])) {
                return ToolResult::error('site_id is required.');
            }

            return ToolResult::success($this->service->getCurrentVisitors((string) $args['site_id'], (bool) ($args['detailed'] ?? false)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
