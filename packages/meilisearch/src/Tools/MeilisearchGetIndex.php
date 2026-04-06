<?php

namespace OpenCompany\Integrations\Meilisearch\Tools;

use OpenCompany\Integrations\Meilisearch\MeilisearchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeilisearchGetIndex implements Tool
{
    /**
     * Create a new MeilisearchGetIndex tool instance.
     */
    public function __construct(
        private MeilisearchService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'meilisearch_get_index';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Meilisearch index, including its UID, primary key, and stats.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'uid' => ['type' => 'string', 'required' => true, 'description' => 'The index unique identifier (e.g., "movies").'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Meilisearch integration is not configured.');
            }

            $uid = $args['uid'] ?? '';
            if (empty($uid)) {
                return ToolResult::error('The "uid" parameter is required.');
            }

            $result = $this->service->getIndex($uid);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
