<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Get a single Acuity Scheduling order.
 */
class AcuityGetOrder extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_get_order';
    }

    public function description(): string
    {
        return 'Get details about a single Acuity Scheduling order by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Order ID.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getOrder($this->intArg($args, 'id'));
    }
}
