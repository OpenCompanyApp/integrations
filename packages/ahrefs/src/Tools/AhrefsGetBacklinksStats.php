<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

/**
 * Get Ahrefs backlink statistics for a target.
 */
class AhrefsGetBacklinksStats extends AbstractAhrefsTool
{
    public function name(): string
    {
        return 'ahrefs_get_backlinks_stats';
    }

    public function description(): string
    {
        return 'Get backlink statistics for a target using Ahrefs Site Explorer.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'required' => true, 'description' => 'Query parameters such as target, date, mode, protocol, and output.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getBacklinksStats($this->arrayArg($args, 'params'));
    }
}
