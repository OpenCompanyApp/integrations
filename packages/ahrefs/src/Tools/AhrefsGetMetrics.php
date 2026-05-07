<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

/**
 * Get Ahrefs Site Explorer overview metrics.
 */
class AhrefsGetMetrics extends AbstractAhrefsTool
{
    public function name(): string
    {
        return 'ahrefs_get_metrics';
    }

    public function description(): string
    {
        return 'Get Site Explorer overview metrics for a target using Ahrefs API v3.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'required' => true, 'description' => 'Query parameters such as target, date, mode, country, protocol, volume_mode, and select.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getMetrics($this->arrayArg($args, 'params'));
    }
}
