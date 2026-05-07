<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * Create a Bitly organization webhook.
 */
class BitlyCreateOrganizationWebhook extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_create_organization_webhook';
    }

    public function description(): string
    {
        return 'Create a webhook for a Bitly organization.';
    }

    public function parameters(): array
    {
        return [
            'organization_guid' => ['type' => 'string', 'required' => true, 'description' => 'Bitly organization GUID.'],
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Webhook body accepted by Bitly.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->createOrganizationWebhook($this->stringArg($args, 'organization_guid'), $this->arrayArg($args, 'body'));
    }
}
