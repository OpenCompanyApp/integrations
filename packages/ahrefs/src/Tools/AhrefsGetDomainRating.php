<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

/**
 * Get Ahrefs domain rating for a target.
 */
class AhrefsGetDomainRating extends AbstractAhrefsTool
{
    public function name(): string
    {
        return 'ahrefs_get_domain_rating';
    }

    public function description(): string
    {
        return 'Get Domain Rating and Ahrefs Rank for a target and date.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'required' => true, 'description' => 'Query parameters such as target, date, protocol, and output.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getDomainRating($this->arrayArg($args, 'params'));
    }
}
