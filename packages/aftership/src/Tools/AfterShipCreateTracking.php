<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Create an AfterShip tracking.
 */
class AfterShipCreateTracking extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_create_tracking';
    protected const DESCRIPTION = 'Create an AfterShip shipment tracking. Provide either top-level tracking fields or a tracking object.';
    protected const METHOD = 'createTracking';

    public function parameters(): array
    {
        return AfterShipParameters::tracking();
    }
}
