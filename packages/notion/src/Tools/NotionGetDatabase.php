<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Notion database by its ID including its full property schema.
 */
class NotionGetDatabase implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_get_database';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Notion database by its ID. Returns the full database schema
        including all property definitions (columns), title, and parent info.
        MD;
    }

    public function parameters(): array
    {
        return [
            'database_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the database to retrieve.'],
        ];
    }

    /**
     * Retrieve a database's full schema by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (database_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $databaseId = $args['database_id'] ?? '';

            if (empty($databaseId)) {
                return ToolResult::error('database_id is required.');
            }

            $result = $this->service->getDatabase($databaseId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
