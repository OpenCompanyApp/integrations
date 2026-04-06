<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

use OpenCompany\Integrations\Appwrite\AppwriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AppwriteCreateDocument implements Tool
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
        return 'appwrite_create_document';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Create a new document in an Appwrite collection.';
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
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'A unique ID for the document (use "unique()" to auto-generate).'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'The document data as key-value pairs matching the collection attributes.'],
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

            if (empty($args['document_id'])) {
                return ToolResult::error('Document ID is required.');
            }

            if (empty($args['data']) || !is_array($args['data'])) {
                return ToolResult::error('Document data is required and must be an object.');
            }

            $result = $this->service->createDocument($args['database_id'], $args['collection_id'], [
                'documentId' => $args['document_id'],
                'data' => $args['data'],
            ]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
