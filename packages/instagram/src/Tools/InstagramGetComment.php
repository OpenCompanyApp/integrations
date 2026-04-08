<?php

namespace OpenCompany\Integrations\Instagram\Tools;

use OpenCompany\Integrations\Instagram\InstagramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Instagram comment by ID.
 *
 * Retrieves full details for a specific comment including
 * text, timestamp, username, and like count.
 */
class InstagramGetComment implements Tool
{
    public function __construct(
        private InstagramService $service,
    ) {}

    public function name(): string
    {
        return 'instagram_get_comment';
    }

    public function description(): string
    {
        return 'Get details of a specific Instagram comment by its ID. Returns the comment text, timestamp, username, and like count.';
    }

    public function parameters(): array
    {
        return [
            'commentId' => ['type' => 'string', 'required' => true, 'description' => 'The comment ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instagram integration is not configured.');
            }

            if (empty($args['commentId'])) {
                return ToolResult::error('commentId is required.');
            }

            $result = $this->service->getComment($args['commentId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
