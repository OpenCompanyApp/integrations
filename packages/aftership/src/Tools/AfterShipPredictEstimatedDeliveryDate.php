<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Predict one AfterShip estimated delivery date.
 */
class AfterShipPredictEstimatedDeliveryDate extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_predict_estimated_delivery_date';
    protected const DESCRIPTION = 'Predict estimated delivery date for one shipment using AfterShip EDD.';
    protected const METHOD = 'predictEstimatedDeliveryDate';

    public function parameters(): array
    {
        return AfterShipParameters::edd();
    }
}
