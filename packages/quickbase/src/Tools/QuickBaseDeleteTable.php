<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Delete a Quickbase table.
 */
class QuickBaseDeleteTable extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_delete_table';
    public const DESCRIPTION = 'Delete a Quickbase table.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
    ];

    /**
     * Delete a table.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteTable($this->requiredString($args, 'tableId', 'tableId'));
    }
}
