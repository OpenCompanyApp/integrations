<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

use OpenCompany\Integrations\Appwrite\AppwriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List databases in the current Appwrite project.
 */
class AppwriteListDatabases implements Tool
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
        return 'appwrite_list_databases';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List all databases in the Appwrite project. Returns database IDs and names.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
            'search' => ['type' => 'string', 'description' => 'Search term to filter databases by name.'],
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
            if (isset($args['search'])) {
                $params['search'] = $args['search'];
            }
            if (isset($args['total'])) {
                $params['total'] = (bool) $args['total'];
            }

            $result = $this->service->listDatabases($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
