<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * List AfterShip courier connections.
 */
class AfterShipListCourierConnections extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_list_courier_connections';
    protected const DESCRIPTION = 'List AfterShip courier connections.';
    protected const METHOD = 'listCourierConnections';

    public function parameters(): array
    {
        return AfterShipParameters::courierConnections();
    }
}
