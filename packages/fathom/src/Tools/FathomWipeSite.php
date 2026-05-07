<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Wipe all analytics data for a Fathom site.
 */
class FathomWipeSite implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_wipe_site';
    }

    public function description(): string
    {
        return 'Wipe all pageviews and event completions from a Fathom site. This is destructive.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
        ];
    }

    /**
     * Wipe site data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id).
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

            return ToolResult::success($this->service->wipeSite((string) $args['site_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
