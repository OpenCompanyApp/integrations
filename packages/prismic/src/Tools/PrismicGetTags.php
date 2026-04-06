<?php

namespace OpenCompany\Integrations\Prismic\Tools;

use OpenCompany\Integrations\Prismic\PrismicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PrismicGetTags implements Tool
{
    /**
     * Create a new PrismicGetTags tool instance.
     */
    public function __construct(
        private PrismicService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'prismic_get_tags';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all tags defined in the Prismic repository. Tags can be used to filter documents in search queries.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array  $args  The tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Prismic integration is not configured.');
            }

            $result = $this->service->getTags();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
