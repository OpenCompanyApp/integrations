<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Get an AfterShip tracking.
 */
class AfterShipGetTracking extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_get_tracking';
    protected const DESCRIPTION = 'Get an AfterShip shipment tracking by ID.';
    protected const METHOD = 'getTracking';

    public function parameters(): array
    {
        return AfterShipParameters::id();
    }
}
