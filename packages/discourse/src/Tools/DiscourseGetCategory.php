<?php

namespace OpenCompany\Integrations\Discourse\Tools;

use OpenCompany\Integrations\Discourse\DiscourseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single category from the Discourse forum.
 *
 * Returns the category details along with its topic list.
 */
class DiscourseGetCategory implements Tool
{
    /**
     * Create a new DiscourseGetCategory tool instance.
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
        return 'discourse_get_category';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get a single Discourse category by ID, including its recent topics and metadata.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [
            'category_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the category to retrieve.'],
        ];
    }

    /**
     * Execute the tool — get a category by ID.
     *
     * @param array $args Tool arguments (category_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Discourse integration is not configured.');
            }

            $categoryId = (int) ($args['category_id'] ?? 0);
            if ($categoryId <= 0) {
                return ToolResult::error('A valid category_id is required.');
            }

            $result = $this->service->getCategory($categoryId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
