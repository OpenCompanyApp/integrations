<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Get class availability from Acuity Scheduling.
 */
class AcuityGetAvailabilityClasses extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_get_availability_classes';
    }

    public function description(): string
    {
        return 'Return available classes for a month.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'description' => 'Query parameters such as appointmentTypeID and month.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getAvailabilityClasses(is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
