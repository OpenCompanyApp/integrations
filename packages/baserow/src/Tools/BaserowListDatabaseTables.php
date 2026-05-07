<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List tables inside a specific Baserow database.
 */
class BaserowListDatabaseTables extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_list_database_tables';
    }

    public function description(): string
    {
        return 'List tables inside a specific Baserow database.';
    }

    public function parameters(): array
    {
        return [
            'database_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow database ID.'],
        ];
    }

    /**
     * List tables for a database.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listDatabaseTables($this->requiredInt($args, 'database_id')));
    }
}
