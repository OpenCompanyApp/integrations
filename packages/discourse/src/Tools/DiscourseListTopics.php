<?php

namespace OpenCompany\Integrations\Discourse\Tools;

use OpenCompany\Integrations\Discourse\DiscourseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list latest topics from the Discourse forum.
 *
 * Returns a paginated list of the most recently active topics.
 */
class DiscourseListTopics implements Tool
{
    /**
     * Create a new DiscourseListTopics tool instance.
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
        return 'discourse_list_topics';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List the latest topics from the Discourse forum. Returns topic titles, categories, and activity metadata.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the tool — list latest topics.
     *
     * @param array $args Tool arguments (page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Discourse integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $result = $this->service->listTopics($page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
