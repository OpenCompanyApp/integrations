<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SupabaseGetRow implements Tool
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
        return 'supabase_get_row';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Get a single row from a Supabase table by its ID.';
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
            'row_id' => ['type' => 'string', 'required' => true, 'description' => 'The row ID.'],
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

            if (empty($args['row_id'])) {
                return ToolResult::error('Row ID is required.');
            }

            $result = $this->service->getRow($args['project_ref'], $args['table_name'], $args['row_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
