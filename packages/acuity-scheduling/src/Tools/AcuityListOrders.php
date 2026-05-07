<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * List Acuity Scheduling store orders.
 */
class AcuityListOrders extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_list_orders';
    }

    public function description(): string
    {
        return 'List package, gift certificate, subscription, and product orders from Acuity Scheduling.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Optional order query parameters.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listOrders(is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
