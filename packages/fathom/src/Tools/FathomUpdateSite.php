<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Update a Fathom site.
 */
class FathomUpdateSite implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_update_site';
    }

    public function description(): string
    {
        return 'Update a Fathom site name or sharing settings.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'name' => ['type' => 'string', 'description' => 'Updated website name.'],
            'sharing' => ['type' => 'string', 'description' => 'Sharing setting: none, private, or public.'],
            'share_password' => ['type' => 'string', 'description' => 'Password required when sharing is private.'],
        ];
    }

    /**
     * Update a site.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, name, sharing, share_password).
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

            return ToolResult::success($this->service->updateSite((string) $args['site_id'], array_intersect_key($args, array_flip(['name', 'sharing', 'share_password']))));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
