<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * List Bitlinks in a Bitly group.
 */
class BitlyListGroupBitlinks extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_list_group_bitlinks';
    }

    public function description(): string
    {
        return 'List Bitlinks in a Bitly group with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'group_guid' => ['type' => 'string', 'required' => true, 'description' => 'Bitly group GUID.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters such as size, page, keyword, query, and archived.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listGroupBitlinks($this->stringArg($args, 'group_guid'), is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
