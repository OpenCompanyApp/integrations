<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Retrieve a Wufoo report by hash or title identifier.
 */
class WufooGetReport extends AbstractWufooTool
{
    public const NAME = 'wufoo_get_report';
    public const DESCRIPTION = 'Get details for a specific Wufoo report by hash or title identifier.';
    public const PARAMETERS = [
        'report_id' => ['type' => 'string', 'required' => true, 'description' => 'The report hash or title identifier.'],
    ];

    /**
     * Get report details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getReport($this->requiredString($args, 'report_id', 'report_id'));
    }
}
