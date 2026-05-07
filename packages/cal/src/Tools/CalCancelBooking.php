<?php

namespace OpenCompany\Integrations\Cal\Tools;

/**
 * Cancel a Cal.com booking.
 */
class CalCancelBooking extends AbstractCalTool
{
    public function name(): string
    {
        return 'cal_cancel_booking';
    }

    public function description(): string
    {
        return 'Cancel a Cal.com booking by booking UID.';
    }

    public function parameters(): array
    {
        return [
            'booking_uid' => ['type' => 'string', 'required' => true, 'description' => 'Booking UID.'],
            'body' => ['type' => 'object', 'description' => 'Optional cancellation payload such as reason.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->cancelBooking(
            $this->stringArg($args, 'booking_uid'),
            is_array($args['body'] ?? null) ? $args['body'] : [],
        );
    }
}
