<?php

namespace OpenCompany\Integrations\Discourse\Tools;

use OpenCompany\Integrations\Discourse\DiscourseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all categories on the Discourse forum.
 *
 * Returns the full category tree including names, descriptions, and IDs.
 */
class DiscourseListCategories implements Tool
{
    /**
     * Create a new DiscourseListCategories tool instance.
     *
     * @param DiscourseService $service The Discourse API service.
     */
    public function __construct(
        private DiscourseService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'discourse_list_categories';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all categories on the Discourse forum. Returns category names, IDs, descriptions, and parent relationships.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — list all categories.
     *
     * @param array $args Tool arguments (none).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Discourse integration is not configured.');
            }

            $result = $this->service->listCategories();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
