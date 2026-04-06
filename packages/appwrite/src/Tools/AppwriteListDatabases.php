<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

use OpenCompany\Integrations\Appwrite\AppwriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

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
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of databases to return (default: 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter databases by name.'],
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

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['search'])) {
                $params['search'] = $args['search'];
            }

            $result = $this->service->listDatabases($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
