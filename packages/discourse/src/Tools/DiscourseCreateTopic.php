<?php

namespace OpenCompany\Integrations\Discourse\Tools;

use OpenCompany\Integrations\Discourse\DiscourseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new topic on the Discourse forum.
 *
 * Creates a topic (first post) in a specified category with a title and body.
 */
class DiscourseCreateTopic implements Tool
{
    /**
     * Create a new DiscourseCreateTopic tool instance.
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
        return 'discourse_create_topic';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new topic in a Discourse category. Requires a title, body content (Markdown), and category ID.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The topic title.'],
            'raw' => ['type' => 'string', 'required' => true, 'description' => 'The body content in Markdown format.'],
            'category' => ['type' => 'integer', 'required' => true, 'description' => 'The category ID to post the topic in.'],
            'tags' => ['type' => 'array', 'description' => 'Optional tags for the topic (strings).'],
        ];
    }

    /**
     * Execute the tool — create a new topic.
     *
     * @param array $args Tool arguments (title, raw, category, tags).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Discourse integration is not configured.');
            }

            $title = $args['title'] ?? '';
            $raw = $args['raw'] ?? '';
            $category = (int) ($args['category'] ?? 0);
            $tags = $args['tags'] ?? [];

            if (empty($title)) {
                return ToolResult::error('A title is required to create a topic.');
            }
            if (empty($raw)) {
                return ToolResult::error('Body content (raw) is required to create a topic.');
            }
            if ($category <= 0) {
                return ToolResult::error('A valid category ID is required to create a topic.');
            }

            $result = $this->service->createTopic($title, $raw, $category, $tags);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
