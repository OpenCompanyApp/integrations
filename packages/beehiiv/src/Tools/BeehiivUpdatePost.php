<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update an existing post in a Beehiiv publication.
 */
class BeehiivUpdatePost implements Tool
{
    /**
     * Create a new BeehiivUpdatePost tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_update_post';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Update an existing post in your Beehiiv publication. Provide the post ID and the fields you want to change.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'post_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the post to update.'],
            'title' => ['type' => 'string', 'description' => 'Updated post title.'],
            'content' => ['type' => 'string', 'description' => 'Updated post content in HTML or Markdown.'],
            'status' => ['type' => 'string', 'description' => 'Updated status: "draft", "confirmed", "scheduled".'],
            'subtitle' => ['type' => 'string', 'description' => 'Updated subtitle.'],
            'audience' => ['type' => 'string', 'description' => 'Updated audience: "free", "premium", or "all".'],
            'thumbnail_url' => ['type' => 'string', 'description' => 'Updated thumbnail URL.'],
            'content_tags' => ['type' => 'array', 'description' => 'Updated array of tag strings.'],
        ];
    }

    /**
     * Execute the tool — update a post in Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beehiiv integration is not configured. Provide an API key and publication ID.');
            }

            $postId = $args['post_id'];
            $data = [];

            $fields = ['title', 'content', 'status', 'subtitle', 'audience', 'thumbnail_url', 'content_tags'];
            foreach ($fields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Specify at least one field besides post_id.');
            }

            $result = $this->service->updatePost($postId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
