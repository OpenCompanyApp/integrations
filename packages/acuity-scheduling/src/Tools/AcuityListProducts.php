<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * List Acuity Scheduling products and packages.
 */
class AcuityListProducts extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_list_products';
    }

    public function description(): string
    {
        return 'List products and packages from Acuity Scheduling.';
    }

    public function parameters(): array
    {
        return [];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listProducts();
    }
}
