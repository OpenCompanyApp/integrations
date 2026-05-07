<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Get a Bitly QR Code.
 */
class BitlyGetQrCode extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_get_qr_code';
    }

    public function description(): string
    {
        return 'Get a Bitly QR Code by ID.';
    }

    public function parameters(): array
    {
        return [
            'qr_code_id' => ['type' => 'string', 'required' => true, 'description' => 'QR Code ID.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getQrCode($this->stringArg($args, 'qr_code_id'));
    }
}
