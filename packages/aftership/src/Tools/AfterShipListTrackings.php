<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * List AfterShip trackings.
 */
class AfterShipListTrackings extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_list_trackings';
    protected const DESCRIPTION = 'List AfterShip shipment trackings with pagination, courier, status, tag, date, and field filters.';
    protected const METHOD = 'listTrackings';

    public function parameters(): array
    {
        return AfterShipParameters::listTrackings();
    }
}
