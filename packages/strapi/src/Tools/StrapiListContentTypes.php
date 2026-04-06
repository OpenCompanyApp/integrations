<?php

namespace OpenCompany\Integrations\Strapi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Strapi\StrapiService;

class StrapiListContentTypes implements Tool
{
    /**
     * Create a new StrapiListContentTypes tool instance.
     */
    public function __construct(
        private StrapiService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'strapi_list_content_types';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all content types defined in the Strapi Content-Type Builder. Returns API IDs, display names, and schema information.';
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

            $result = $this->service->listContentTypes();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
