<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Get available dates for an Acuity Scheduling appointment type.
 */
class AcuityGetAvailabilityDates extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_get_availability_dates';
    }

    public function description(): string
    {
        return 'Return dates with availability for a month and appointment type.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'required' => true, 'description' => 'Query parameters such as appointmentTypeID and month.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getAvailabilityDates($this->arrayArg($args, 'params'));
    }
}
