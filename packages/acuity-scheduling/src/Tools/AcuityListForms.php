<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * List Acuity Scheduling intake forms.
 */
class AcuityListForms extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_list_forms';
    }

    public function description(): string
    {
        return 'List intake forms and their fields from Acuity Scheduling.';
    }

    public function parameters(): array
    {
        return [];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listForms();
    }
}
