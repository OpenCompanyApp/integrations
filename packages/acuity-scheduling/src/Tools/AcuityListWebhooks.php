<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * List dynamic Acuity Scheduling webhooks.
 */
class AcuityListWebhooks extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_list_webhooks';
    }

    public function description(): string
    {
        return 'List dynamic webhook subscriptions in Acuity Scheduling.';
    }

    public function parameters(): array
    {
        return [];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listWebhooks();
    }
}
