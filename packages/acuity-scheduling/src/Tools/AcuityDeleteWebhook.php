<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Delete a dynamic Acuity Scheduling webhook.
 */
class AcuityDeleteWebhook extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_delete_webhook';
    }

    public function description(): string
    {
        return 'Delete a dynamic webhook subscription by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Webhook ID.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->deleteWebhook($this->intArg($args, 'id'));
    }
}
