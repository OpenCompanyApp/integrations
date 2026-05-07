<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Get a Bitlink click summary.
 */
class BitlyGetClickSummary extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_get_click_summary';
    }

    public function description(): string
    {
        return 'Get total click summary data for a Bitlink.';
    }

    public function parameters(): array
    {
        return [
            'bitlink' => ['type' => 'string', 'required' => true, 'description' => 'Bitlink identifier.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters such as unit, units, and unit_reference.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getClickSummary($this->stringArg($args, 'bitlink'), is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
