<?php

namespace OpenCompany\Integrations\Bitly\Tools;

/**
 * List Bitly organization webhooks.
 */
class BitlyListOrganizationWebhooks extends AbstractBitlyTool
{
    public function name(): string
    {
        return 'bitly_list_organization_webhooks';
    }

    public function description(): string
    {
        return 'List webhooks for a Bitly organization.';
    }

    public function parameters(): array
    {
        return [
            'organization_guid' => ['type' => 'string', 'required' => true, 'description' => 'Bitly organization GUID.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listOrganizationWebhooks($this->stringArg($args, 'organization_guid'));
    }
}
