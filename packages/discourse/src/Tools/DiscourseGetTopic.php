<?php

namespace OpenCompany\Integrations\Discourse\Tools;

use OpenCompany\Integrations\Discourse\DiscourseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single topic from the Discourse forum.
 *
 * Returns the topic details including all posts in the topic.
 */
class DiscourseGetTopic implements Tool
{
    /**
     * Create a new DiscourseGetTopic tool instance.
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
        return 'discourse_get_topic';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get a single Discourse topic by ID, including its posts, author, and metadata.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [
            'topic_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the topic to retrieve.'],
        ];
    }

    /**
     * Execute the tool — get a topic by ID.
     *
     * @param array $args Tool arguments (topic_id).
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

            $result = $this->service->getTopic($topicId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
