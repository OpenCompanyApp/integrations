<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SupabaseListRows implements Tool
{
    /**
     * @param SupabaseService $service The Supabase service instance.
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'supabase_list_rows';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List rows in a Supabase table. Returns row data and metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'project_ref' => ['type' => 'string', 'required' => true, 'description' => 'The project reference ID.'],
            'table_name' => ['type' => 'string', 'required' => true, 'description' => 'The table name or ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of rows to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'select' => ['type' => 'string', 'description' => 'Comma-separated list of columns to select.'],
            'order' => ['type' => 'string', 'description' => 'Column to order by, with optional direction (e.g. "id.desc").'],
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
                return ToolResult::error('Supabase integration is not configured.');
            }

            if (empty($args['project_ref'])) {
                return ToolResult::error('Project reference ID is required.');
            }

            if (empty($args['table_name'])) {
                return ToolResult::error('Table name is required.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['select'])) {
                $params['select'] = $args['select'];
            }
            if (isset($args['order'])) {
                $params['order'] = $args['order'];
            }

            $result = $this->service->listRows($args['project_ref'], $args['table_name'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
