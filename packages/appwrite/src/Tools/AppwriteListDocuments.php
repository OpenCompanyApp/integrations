<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

use OpenCompany\Integrations\Appwrite\AppwriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AppwriteListDocuments implements Tool
{
    /**
     * @param AppwriteService $service The Appwrite service instance.
     */
    public function __construct(
        private AppwriteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'appwrite_list_documents';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List documents in an Appwrite collection. Returns document data and metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'database_id' => ['type' => 'string', 'required' => true, 'description' => 'The database ID.'],
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The collection ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of documents to return (default: 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array $args The tool arguments.
     * @return ToolResult The result of the tool execution.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Appwrite integration is not configured.');
            }

            if (empty($args['database_id'])) {
                return ToolResult::error('Database ID is required.');
            }

            if (empty($args['collection_id'])) {
                return ToolResult::error('Collection ID is required.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listDocuments($args['database_id'], $args['collection_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
