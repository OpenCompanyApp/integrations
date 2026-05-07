<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

/**
 * List Ahrefs organic competitors for a target.
 */
class AhrefsListOrganicCompetitors extends AbstractAhrefsTool
{
    public function name(): string
    {
        return 'ahrefs_list_organic_competitors';
    }

    public function description(): string
    {
        return 'List organic search competitors for a target.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'required' => true, 'description' => 'Query parameters such as target, mode, date, country, limit, offset, and select.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listOrganicCompetitors($this->arrayArg($args, 'params'));
    }
}
