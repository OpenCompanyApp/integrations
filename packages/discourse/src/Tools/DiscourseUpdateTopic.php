<?php

namespace OpenCompany\Integrations\Discourse\Tools;

use OpenCompany\Integrations\Discourse\DiscourseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update an existing topic on the Discourse forum.
 *
 * Allows changing the topic's title and/or moving it to a different category.
 */
class DiscourseUpdateTopic implements Tool
{
    /**
     * Create a new DiscourseUpdateTopic tool instance.
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
        return 'discourse_update_topic';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Update an existing Discourse topic\'s title or move it to a different category.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [
            'topic_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the topic to update.'],
            'title' => ['type' => 'string', 'description' => 'The new title for the topic (optional).'],
            'category' => ['type' => 'integer', 'description' => 'The new category ID to move the topic to (optional).'],
        ];
    }

    /**
     * Execute the tool — update a topic.
     *
     * @param array $args Tool arguments (topic_id, title, category).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Discourse integration is not configured.');
            }

            $topicId = (int) ($args['topic_id'] ?? 0);
            if ($topicId <= 0) {
                return ToolResult::error('A valid topic_id is required.');
            }

            $title = $args['title'] ?? null;
            $category = isset($args['category']) ? (int) $args['category'] : null;

            if ($title === null && $category === null) {
                return ToolResult::error('Provide at least a title or category to update.');
            }

            $result = $this->service->updateTopic($topicId, $title, $category);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
