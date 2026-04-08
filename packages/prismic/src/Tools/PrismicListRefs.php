<?php

namespace OpenCompany\Integrations\Prismic\Tools;

use OpenCompany\Integrations\Prismic\PrismicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PrismicListRefs implements Tool
{
    /**
     * Create a new PrismicListRefs tool instance.
     */
    public function __construct(
        private PrismicService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'prismic_list_refs';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all refs (releases and drafts) for the Prismic repository. The master ref points to the published content; other refs point to drafts or releases in progress.';
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

            $result = $this->service->listRefs();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
