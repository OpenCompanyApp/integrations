<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Mark an AfterShip tracking as completed.
 */
class AfterShipMarkTrackingCompleted extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_mark_tracking_completed';
    protected const DESCRIPTION = 'Mark an AfterShip shipment tracking as completed by ID.';
    protected const METHOD = 'markTrackingCompleted';

    public function parameters(): array
    {
        return AfterShipParameters::id() + [
            'reason' => ['type' => 'string', 'required' => false, 'description' => 'Optional completion reason.'],
        ];
    }
}
