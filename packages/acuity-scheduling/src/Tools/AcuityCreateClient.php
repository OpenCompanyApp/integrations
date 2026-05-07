<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Create a client in Acuity Scheduling.
 */
class AcuityCreateClient extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_create_client';
    }

    public function description(): string
    {
        return 'Create a new Acuity Scheduling client record.';
    }

    public function parameters(): array
    {
        return [
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Client body such as firstName, lastName, email, and phone.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->createClient($this->arrayArg($args, 'body'));
    }
}
