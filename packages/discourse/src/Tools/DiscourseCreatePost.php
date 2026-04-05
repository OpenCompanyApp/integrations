<?php

namespace OpenCompany\Integrations\Discourse\Tools;

use OpenCompany\Integrations\Discourse\DiscourseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a post (reply) on an existing Discourse topic.
 *
 * Posts a new reply to the specified topic using Markdown content.
 */
class DiscourseCreatePost implements Tool
{
    /**
     * Create a new DiscourseCreatePost tool instance.
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
        return 'discourse_create_post';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Reply to an existing Discourse topic with a new post. Provide the topic ID and body content in Markdown.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [
            'topic_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the topic to reply to.'],
            'raw' => ['type' => 'string', 'required' => true, 'description' => 'The post body content in Markdown format.'],
        ];
    }

    /**
     * Execute the tool — create a post reply.
     *
     * @param array $args Tool arguments (topic_id, raw).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Discourse integration is not configured.');
            }

            $topicId = (int) ($args['topic_id'] ?? 0);
            $raw = $args['raw'] ?? '';

            if ($topicId <= 0) {
                return ToolResult::error('A valid topic_id is required.');
            }
            if (empty($raw)) {
                return ToolResult::error('Body content (raw) is required to create a post.');
            }

            $result = $this->service->createPost($topicId, $raw);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
