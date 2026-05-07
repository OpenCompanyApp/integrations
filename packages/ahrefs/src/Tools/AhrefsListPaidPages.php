<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

/**
 * List paid search pages for an Ahrefs target.
 */
class AhrefsListPaidPages extends AbstractAhrefsTool
{
    public function name(): string
    {
        return 'ahrefs_list_paid_pages';
    }

    public function description(): string
    {
        return 'List pages from a target ranking in paid search results.';
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
        return $this->service->listPaidPages($this->arrayArg($args, 'params'));
    }
}
