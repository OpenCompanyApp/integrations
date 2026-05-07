<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

/**
 * Enrich a person and their company in one Clearbit call.
 */
class ClearbitEnrichCombined extends AbstractClearbitTool
{
    public function name(): string
    {
        return 'clearbit_enrich_combined';
    }

    public function description(): string
    {
        return 'Look up a person and associated company by email using Clearbit combined enrichment.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address to enrich.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->enrichCombined($this->stringArg($args, 'email'));
    }
}
