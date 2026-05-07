<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Create a Bitly QR Code.
 */
class BitlyCreateQrCode extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_create_qr_code';
    }

    public function description(): string
    {
        return 'Create a Bitly QR Code for a destination such as a Bitlink or long URL.';
    }

    public function parameters(): array
    {
        return [
            'body' => ['type' => 'object', 'required' => true, 'description' => 'QR Code body accepted by Bitly, including destination and optional title/customization.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->createQrCode($this->arrayArg($args, 'body'));
    }
}
