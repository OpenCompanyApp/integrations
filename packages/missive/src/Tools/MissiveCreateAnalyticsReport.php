<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Create an asynchronous Missive analytics report.
 */
class MissiveCreateAnalyticsReport extends AbstractMissiveTool
{
    public const NAME = 'missive_create_analytics_report';
    public const DESCRIPTION = 'Create an asynchronous Missive analytics report. Poll get_analytics_report with the returned ID.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Analytics report payload with organization, start, end, and time_zone.'],
    ];

    /**
     * Create an analytics report.
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

        return $this->service->createAnalyticsReport($body);
    }
}
