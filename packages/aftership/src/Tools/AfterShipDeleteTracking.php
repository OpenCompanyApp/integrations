<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Delete an AfterShip tracking.
 */
class AfterShipDeleteTracking extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_delete_tracking';
    protected const DESCRIPTION = 'Delete an AfterShip shipment tracking by ID.';
    protected const METHOD = 'deleteTracking';

    public function parameters(): array
    {
        return AfterShipParameters::id();
    }
}
