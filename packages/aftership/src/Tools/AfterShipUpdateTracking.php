<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Update an AfterShip tracking.
 */
class AfterShipUpdateTracking extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_update_tracking';
    protected const DESCRIPTION = 'Update an AfterShip shipment tracking by ID.';
    protected const METHOD = 'updateTracking';

    public function parameters(): array
    {
        return AfterShipParameters::id() + AfterShipParameters::tracking(false);
    }
}
