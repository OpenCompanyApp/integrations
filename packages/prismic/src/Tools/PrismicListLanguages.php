<?php

namespace OpenCompany\Integrations\Prismic\Tools;

use OpenCompany\Integrations\Prismic\PrismicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PrismicListLanguages implements Tool
{
    /**
     * Create a new PrismicListLanguages tool instance.
     */
    public function __construct(
        private PrismicService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'prismic_list_languages';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all languages configured in the Prismic repository. Returns language codes and names that can be used for querying content in specific locales.';
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

            $result = $this->service->listLanguages();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
