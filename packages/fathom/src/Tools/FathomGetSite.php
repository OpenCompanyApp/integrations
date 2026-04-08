<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\Integrations\Fathom\FathomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details for a specific Fathom site.
 *
 * Returns the full site object including name, domain, tracking code, and settings.
 */
class FathomGetSite implements Tool
{
    /**
     * Create a new FathomGetSite tool instance.
     *
     * @param  FathomService  $service  The Fathom API service instance.
     */
    public function __construct(
        private FathomService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'fathom_get_site';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'Get details for a specific Fathom Analytics site by ID. Returns site name, domain, tracking code, and other configuration.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The Fathom site ID (e.g., "CDCLS").'],
        ];
    }

    /**
     * Execute the tool and return site details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';
            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }

            $result = $this->service->getSite($siteId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
