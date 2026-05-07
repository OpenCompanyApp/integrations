<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * List entries exposed by a Wufoo report.
 */
class WufooListReportEntries extends AbstractWufooTool
{
    public const NAME = 'wufoo_list_report_entries';
    public const DESCRIPTION = 'List entries available through a Wufoo report, with pagination, sorting, and filters.';
    public const PARAMETERS = [
        'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pageStart, pageSize, sort, sortDirection, Filter1, or Match.'],
    ];

    /**
     * List report entries.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listReportEntries(
            $this->requiredString($args, 'report_id', 'report_id'),
            $this->arrayArg($args, 'params'),
        );
    }
}
