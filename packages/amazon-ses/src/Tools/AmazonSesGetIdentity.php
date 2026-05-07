<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

/**
 * Get Amazon SES identity details.
 */
class AmazonSesGetIdentity extends AbstractAmazonSesTool
{
    public function name(): string { return 'amazonses_get_identity'; }

    public function description(): string { return 'Get Amazon SES identity details for an email address or domain.'; }

    public function parameters(): array
    {
        return [
            'identity' => ['type' => 'string', 'required' => true, 'description' => 'Email address or domain identity.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getIdentity($this->stringArg($args, 'identity'));
    }
}
