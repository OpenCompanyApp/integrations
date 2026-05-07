<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Delete Quickbase records matching a where clause.
 */
class QuickBaseDeleteRecords extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_delete_records';
    public const DESCRIPTION = 'Delete Quickbase records matching a where clause.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'where' => ['type' => 'string', 'required' => true, 'description' => 'Quickbase query expression selecting records to delete.'],
    ];

    /**
     * Delete records.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteRecords($this->requiredString($args, 'tableId', 'tableId'), $this->requiredString($args, 'where', 'where'));
    }
}
