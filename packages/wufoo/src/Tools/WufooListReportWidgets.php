<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * List widgets configured on a Wufoo report.
 */
class WufooListReportWidgets extends AbstractWufooTool
{
    public const NAME = 'wufoo_list_report_widgets';
    public const DESCRIPTION = 'List widgets configured on a Wufoo report.';
    public const PARAMETERS = [
        'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pretty.'],
    ];

    /**
     * List report widgets.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listReportWidgets(
            $this->requiredString($args, 'report_id', 'report_id'),
            $this->arrayArg($args, 'params'),
        );
    }
}
