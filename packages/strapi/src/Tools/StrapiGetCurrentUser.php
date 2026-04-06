<?php

namespace OpenCompany\Integrations\Strapi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Strapi\StrapiService;

class StrapiGetCurrentUser implements Tool
{
    /**
     * Create a new StrapiGetCurrentUser tool instance.
     */
    public function __construct(
        private StrapiService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'strapi_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Strapi user. Useful for verifying the API token and checking permissions.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool.
     *
     * @param  array  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Strapi integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
