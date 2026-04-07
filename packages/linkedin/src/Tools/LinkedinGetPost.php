<?php

namespace OpenCompany\Integrations\Linkedin\Tools;

use OpenCompany\Integrations\Linkedin\LinkedinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a LinkedIn UGC post by ID.
 *
 * Returns the full post including its content and metadata.
 */
class LinkedinGetPost implements Tool
{
    /**
     * @param  LinkedinService  $service  The LinkedIn API client
     */
    public function __construct(
        private LinkedinService $service,
    ) {}

    public function name(): string
    {
        return 'linkedin_get_post';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a LinkedIn UGC post by its ID.
        Returns the full post including content, lifecycle state, and visibility.
        MD;
    }

    public function parameters(): array
    {
        return [
            'post_id' => ['type' => 'string', 'required' => true, 'description' => 'LinkedIn UGC post URN or ID (e.g. "urn:li:ugcPost:123456789").'],
        ];
    }

    /**
     * Retrieve a LinkedIn post by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (post_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $id = $args['post_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('post_id is required.');
            }

            $result = $this->service->getPost($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
