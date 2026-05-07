<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Update Quickbase table metadata.
 */
class QuickBaseUpdateTable extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_update_table';
    public const DESCRIPTION = 'Update Quickbase table metadata.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Table attributes to update.'],
    ];

    /**
     * Update a table.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'body');
        if ($body === []) {
            throw new \InvalidArgumentException('body is required.');
        }

        return $this->service->updateTable($this->requiredString($args, 'tableId', 'tableId'), $body);
    }
}
