<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Reschedule an Acuity Scheduling appointment.
 */
class AcuityRescheduleAppointment extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_reschedule_appointment';
    }

    public function description(): string
    {
        return 'Reschedule an appointment to a new datetime, calendar, or both.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Appointment ID.'],
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Reschedule payload such as datetime, calendarID, admin, and noEmail.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->rescheduleAppointment($this->intArg($args, 'id'), $this->arrayArg($args, 'body'));
    }
}
