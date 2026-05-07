<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

/**
 * List broken backlinks for an Ahrefs target.
 */
class AhrefsListBrokenBacklinks extends AbstractAhrefsTool
{
    public function name(): string
    {
        return 'ahrefs_list_broken_backlinks';
    }

    public function description(): string
    {
        return 'List broken backlinks pointing to a target.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'required' => true, 'description' => 'Query parameters such as target, mode, limit, offset, select, and where.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listBrokenBacklinks($this->arrayArg($args, 'params'));
    }
}
