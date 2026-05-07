<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Get Bitlink click metrics by referrer.
 */
class BitlyGetClickReferrers extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_get_click_referrers';
    }

    public function description(): string
    {
        return 'Get click counts grouped by referrer for a Bitlink.';
    }

    public function parameters(): array
    {
        return [
            'bitlink' => ['type' => 'string', 'required' => true, 'description' => 'Bitlink identifier.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters such as unit, units, size, and unit_reference.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getClickReferrers($this->stringArg($args, 'bitlink'), is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
