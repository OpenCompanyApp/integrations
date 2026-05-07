<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Get Quickbase report metadata.
 */
class QuickBaseGetReport extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_get_report';
    public const DESCRIPTION = 'Get metadata for a Quickbase report.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'reportId' => ['type' => 'string', 'required' => true, 'description' => 'The report ID.'],
    ];

    /**
     * Get report metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getReport($this->requiredString($args, 'tableId', 'tableId'), $this->requiredString($args, 'reportId', 'reportId'));
    }
}
