<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * List field definitions for a Wufoo report.
 */
class WufooListReportFields extends AbstractWufooTool
{
    public const NAME = 'wufoo_list_report_fields';
    public const DESCRIPTION = 'List the form field structure used by a Wufoo report.';
    public const PARAMETERS = [
        'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as system or pretty.'],
    ];

    /**
     * List report fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listReportFields(
            $this->requiredString($args, 'report_id', 'report_id'),
            $this->arrayArg($args, 'params'),
        );
    }
}
