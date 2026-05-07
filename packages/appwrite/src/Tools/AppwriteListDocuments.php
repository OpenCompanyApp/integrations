<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

use OpenCompany\Integrations\Appwrite\AppwriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List documents in an Appwrite collection.
 */
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
            'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
            'total' => ['type' => 'boolean', 'description' => 'Whether Appwrite should calculate total count.'],
            'limit' => ['type' => 'integer', 'description' => 'Compatibility helper that is converted to an Appwrite limit() query.'],
            'offset' => ['type' => 'integer', 'description' => 'Compatibility helper that is converted to an Appwrite offset() query.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args The tool arguments.
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

            $queries = isset($args['queries']) && is_array($args['queries']) ? $args['queries'] : [];
            if (isset($args['limit'])) {
                $queries[] = 'limit('.(int) $args['limit'].')';
            }
            if (isset($args['offset'])) {
                $queries[] = 'offset('.(int) $args['offset'].')';
            }

            $params = [];
            if ($queries !== []) {
                $params['queries'] = $queries;
            }
            if (isset($args['total'])) {
                $params['total'] = (bool) $args['total'];
            }

            $result = $this->service->listDocuments($args['database_id'], $args['collection_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
