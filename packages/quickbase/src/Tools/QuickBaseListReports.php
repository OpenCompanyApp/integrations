<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * List reports for a Quickbase table.
 */
class QuickBaseListReports extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_list_reports';
    public const DESCRIPTION = 'List reports for a Quickbase table.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
    ];

    /**
     * List reports.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listReports($this->requiredString($args, 'tableId', 'tableId'));
    }
}
