<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Update a client in Acuity Scheduling.
 */
class AcuityUpdateClient extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_update_client';
    }

    public function description(): string
    {
        return 'Update an Acuity Scheduling client by lookup parameters and replacement fields.';
    }

    public function parameters(): array
    {
        return [
            'lookup' => ['type' => 'object', 'required' => true, 'description' => 'Query parameters used to identify the client, such as email.'],
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Client fields to update.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->updateClient($this->arrayArg($args, 'lookup'), $this->arrayArg($args, 'body'));
    }
}
