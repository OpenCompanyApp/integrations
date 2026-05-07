<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Create a Fathom site.
 */
class FathomCreateSite implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_create_site';
    }

    public function description(): string
    {
        return 'Create a new Fathom site with a name and optional sharing settings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Website name.'],
            'sharing' => ['type' => 'string', 'description' => 'Sharing setting: none, private, or public.'],
            'share_password' => ['type' => 'string', 'description' => 'Password required when sharing is private.'],
        ];
    }

    /**
     * Create a site.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, sharing, share_password).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }
            if (empty($args['name'])) {
                return ToolResult::error('name is required.');
            }

            return ToolResult::success($this->service->createSite(array_intersect_key($args, array_flip(['name', 'sharing', 'share_password']))));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
