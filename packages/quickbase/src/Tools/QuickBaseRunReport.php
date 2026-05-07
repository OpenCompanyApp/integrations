<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Run a Quickbase report.
 */
class QuickBaseRunReport extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_run_report';
    public const DESCRIPTION = 'Run a Quickbase report and return its data.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'reportId' => ['type' => 'string', 'required' => true, 'description' => 'The report ID.'],
        'body' => ['type' => 'object', 'description' => 'Optional report run options.'],
    ];

    /**
     * Run report.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->runReport(
            $this->requiredString($args, 'tableId', 'tableId'),
            $this->requiredString($args, 'reportId', 'reportId'),
            $this->arrayArg($args, 'body'),
        );
    }
}
