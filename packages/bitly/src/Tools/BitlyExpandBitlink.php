<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Expand a Bitlink to its long URL.
 */
class BitlyExpandBitlink extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_expand_bitlink';
    }

    public function description(): string
    {
        return 'Expand a Bitlink to retrieve its long URL.';
    }

    public function parameters(): array
    {
        return [
            'bitlink' => ['type' => 'string', 'required' => true, 'description' => 'Bitlink identifier such as bit.ly/abc123.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->expandBitlink($this->stringArg($args, 'bitlink'));
    }
}
