<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Detect AfterShip courier candidates.
 */
class AfterShipDetectCourier extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_detect_courier';
    protected const DESCRIPTION = 'Detect likely courier candidates for a tracking number.';
    protected const METHOD = 'detectCourier';

    public function parameters(): array
    {
        return AfterShipParameters::detectCourier();
    }
}
