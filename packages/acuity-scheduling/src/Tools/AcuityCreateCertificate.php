<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Create an Acuity Scheduling package or coupon certificate.
 */
class AcuityCreateCertificate extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_create_certificate';
    }

    public function description(): string
    {
        return 'Create a package or coupon certificate code in Acuity Scheduling.';
    }

    public function parameters(): array
    {
        return [
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Certificate body. Submit productID or couponID, with optional certificate and email.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->createCertificate($this->arrayArg($args, 'body'));
    }
}
