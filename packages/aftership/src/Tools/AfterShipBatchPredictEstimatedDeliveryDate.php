<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Predict multiple AfterShip estimated delivery dates.
 */
class AfterShipBatchPredictEstimatedDeliveryDate extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_batch_predict_estimated_delivery_date';
    protected const DESCRIPTION = 'Predict estimated delivery dates for multiple shipments using AfterShip EDD batch prediction.';
    protected const METHOD = 'batchPredictEstimatedDeliveryDate';

    public function parameters(): array
    {
        return [
            'shipments' => ['type' => 'array', 'required' => false, 'description' => 'Batch shipment prediction payload.', 'items' => ['type' => 'object']],
            'raw' => ['type' => 'object', 'required' => false, 'description' => 'Full batch prediction payload.'],
        ];
    }
}
