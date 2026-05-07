<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Create an Acuity Scheduling appointment.
 */
class AcuityCreateAppointment extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_create_appointment';
    }

    public function description(): string
    {
        return 'Create an appointment in Acuity Scheduling.';
    }

    public function parameters(): array
    {
        return [
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Appointment body with datetime, appointmentTypeID, firstName, lastName, email, and optional calendarID, timezone, fields, notes, labels, or smsOptIn.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->createAppointment($this->arrayArg($args, 'body'));
    }
}
