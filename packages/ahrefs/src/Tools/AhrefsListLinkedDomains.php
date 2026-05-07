<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

/**
 * List outgoing linked domains for an Ahrefs target.
 */
class AhrefsListLinkedDomains extends AbstractAhrefsTool
{
    public function name(): string
    {
        return 'ahrefs_list_linked_domains';
    }

    public function description(): string
    {
        return 'List domains linked from the target.';
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
        return $this->service->listLinkedDomains($this->arrayArg($args, 'params'));
    }
}
