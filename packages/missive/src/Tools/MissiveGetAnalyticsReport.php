<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Get an asynchronous Missive analytics report.
 */
class MissiveGetAnalyticsReport extends AbstractMissiveTool
{
    public const NAME = 'missive_get_analytics_report';
    public const DESCRIPTION = 'Get a Missive analytics report by ID after it has been generated.';
    public const PARAMETERS = [
        'report_id' => ['type' => 'string', 'required' => true, 'description' => 'Analytics report UUID returned by create_analytics_report.'],
    ];

    /**
     * Get an analytics report.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getAnalyticsReport($this->requiredString($args, 'report_id', 'report_id'));
    }
}
