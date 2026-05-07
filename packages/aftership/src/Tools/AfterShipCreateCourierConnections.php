<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Create AfterShip courier connections.
 */
class AfterShipCreateCourierConnections extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_create_courier_connections';
    protected const DESCRIPTION = 'Create AfterShip courier connections with the payload shape documented by AfterShip.';
    protected const METHOD = 'createCourierConnections';

    public function parameters(): array
    {
        return AfterShipParameters::payload('Courier connection creation payload.');
    }
}
