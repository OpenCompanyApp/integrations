<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Create a dynamic Acuity Scheduling webhook.
 */
class AcuityCreateWebhook extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_create_webhook';
    }

    public function description(): string
    {
        return 'Create a dynamic webhook subscription for Acuity Scheduling events.';
    }

    public function parameters(): array
    {
        return [
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Webhook body with event and target URL.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->createWebhook($this->arrayArg($args, 'body'));
    }
}
