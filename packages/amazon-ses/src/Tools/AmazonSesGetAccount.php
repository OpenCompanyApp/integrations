<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

/**
 * Get Amazon SES account-level sending details.
 */
class AmazonSesGetAccount extends AbstractAmazonSesTool
{
    public function name(): string { return 'amazonses_get_account'; }

    public function description(): string { return 'Get Amazon SES account-level sending details.'; }

    public function parameters(): array { return []; }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getAccount();
    }
}
