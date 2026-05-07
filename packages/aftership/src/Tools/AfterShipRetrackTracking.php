<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Retrack an expired AfterShip tracking.
 */
class AfterShipRetrackTracking extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_retrack_tracking';
    protected const DESCRIPTION = 'Retrack an expired AfterShip shipment tracking by ID.';
    protected const METHOD = 'retrackTracking';

    public function parameters(): array
    {
        return AfterShipParameters::id();
    }
}
