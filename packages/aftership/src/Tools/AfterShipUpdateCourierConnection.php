<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Update an AfterShip courier connection.
 */
class AfterShipUpdateCourierConnection extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_update_courier_connection';
    protected const DESCRIPTION = 'Update an AfterShip courier connection by ID.';
    protected const METHOD = 'updateCourierConnection';

    public function parameters(): array
    {
        return AfterShipParameters::id() + AfterShipParameters::payload('Courier connection patch payload.');
    }
}
