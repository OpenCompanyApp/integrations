<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Update editable details on an Acuity Scheduling appointment.
 */
class AcuityUpdateAppointment extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_update_appointment';
    }

    public function description(): string
    {
        return 'Update editable Acuity Scheduling appointment details such as client info, notes, fields, labels, or smsOptIn.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Appointment ID.'],
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Editable appointment fields.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->updateAppointment($this->intArg($args, 'id'), $this->arrayArg($args, 'body'));
    }
}
