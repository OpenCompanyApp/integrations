<?php

namespace OpenCompany\Integrations\Meilisearch\Tools;

use OpenCompany\Integrations\Meilisearch\MeilisearchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeilisearchCreateIndex implements Tool
{
    /**
     * Create a new MeilisearchCreateIndex tool instance.
     */
    public function __construct(
        private MeilisearchService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'meilisearch_create_index';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new index in Meilisearch. Returns a task object that can be used to track the creation progress.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'uid' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier for the new index (e.g., "movies").'],
            'primary_key' => ['type' => 'string', 'description' => 'The primary key field for the index (e.g., "id"). Optional — can be set later.'],
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

            $primaryKey = $args['primary_key'] ?? null;
            $result = $this->service->createIndex($uid, $primaryKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
