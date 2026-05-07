<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List every Baserow table visible to the configured database token.
 */
class BaserowListAllTables extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_list_all_tables';
    }

    public function description(): string
    {
        return 'List every Baserow table visible to the configured database token.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional Baserow query parameters.'],
        ];
    }

    /**
     * List all visible Baserow tables.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listAllTables($this->arrayArg($args, 'params')));
    }
}
