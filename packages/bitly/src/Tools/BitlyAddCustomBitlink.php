<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Add a custom back-half to a Bitlink.
 */
class BitlyAddCustomBitlink extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_add_custom_bitlink';
    }

    public function description(): string
    {
        return 'Add a custom back-half to an existing Bitlink on a custom domain.';
    }

    public function parameters(): array
    {
        return [
            'custom_bitlink' => ['type' => 'string', 'required' => true, 'description' => 'Custom Bitlink such as example.test/campaign.'],
            'bitlink_id' => ['type' => 'string', 'required' => true, 'description' => 'Existing Bitlink ID.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->addCustomBitlink($this->stringArg($args, 'custom_bitlink'), $this->stringArg($args, 'bitlink_id'));
    }
}
