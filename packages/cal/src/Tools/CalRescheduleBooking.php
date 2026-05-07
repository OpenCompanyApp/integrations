<?php

namespace OpenCompany\Integrations\Cal\Tools;

/**
 * Reschedule a Cal.com booking.
 */
class CalRescheduleBooking extends AbstractCalTool
{
    public function name(): string
    {
        return 'cal_reschedule_booking';
    }

    public function description(): string
    {
        return 'Reschedule a Cal.com booking by booking UID.';
    }

    public function parameters(): array
    {
        return [
            'booking_uid' => ['type' => 'string', 'required' => true, 'description' => 'Booking UID.'],
            'body' => ['type' => 'object', 'required' => true, 'description' => 'Reschedule payload, usually including start and related booking fields.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->rescheduleBooking(
            $this->stringArg($args, 'booking_uid'),
            is_array($args['body'] ?? null) ? $args['body'] : [],
        );
    }
}
