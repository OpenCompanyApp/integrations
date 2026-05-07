<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all databases (applications) in the Baserow workspace.
 *
 * Returns a paginated list of databases including their names, IDs,
 * and associated workspace information.
 */
class BaserowListDatabases implements Tool
{
    /**
     * @param  BaserowService  $service  The Baserow API client.
     */
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_list_databases';
    }

    public function description(): string
    {
        return 'List all databases (applications) in the Baserow workspace. Returns database names, IDs, and types for navigation.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based). Defaults to 1.'],
            'size' => ['type' => 'integer', 'description' => 'Number of databases per page. Defaults to 100.'],
        ];
    }

    /**
     * List Baserow databases.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Baserow integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $size = isset($args['size']) ? (int) $args['size'] : 100;

            $result = $this->service->listDatabases($page, $size);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
