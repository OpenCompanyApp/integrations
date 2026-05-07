<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Count entries exposed by a Wufoo report.
 */
class WufooCountReportEntries extends AbstractWufooTool
{
    public const NAME = 'wufoo_count_report_entries';
    public const DESCRIPTION = 'Count entries available through a Wufoo report.';
    public const PARAMETERS = [
        'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pretty.'],
    ];

    /**
     * Count report entries.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->countReportEntries(
            $this->requiredString($args, 'report_id', 'report_id'),
            $this->arrayArg($args, 'params'),
        );
    }
}
