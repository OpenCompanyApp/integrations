<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * List payment transactions for an Acuity Scheduling appointment.
 */
class AcuityListAppointmentPayments extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_list_appointment_payments';
    }

    public function description(): string
    {
        return 'Retrieve payment transactions for a specific Acuity Scheduling appointment.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Appointment ID.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->listAppointmentPayments($this->intArg($args, 'id'));
    }
}
