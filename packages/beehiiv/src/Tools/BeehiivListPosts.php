<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list posts from a Beehiiv publication.
 *
 * Supports filtering by status, and pagination via limit/page parameters.
 */
class BeehiivListPosts implements Tool
{
    /**
     * Create a new BeehiivListPosts tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_list_posts';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List posts from your Beehiiv publication. Filter by status (draft, confirmed, etc.) and paginate with limit/page.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by post status: "draft", "confirmed", "scheduled", "published". Omit to list all.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of posts to return per page (default: 20, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the tool — list posts from Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beehiiv integration is not configured. Provide an API key and publication ID.');
            }

            $params = [];

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listPosts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
