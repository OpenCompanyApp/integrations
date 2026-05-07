<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Get an AfterShip courier connection.
 */
class AfterShipGetCourierConnection extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_get_courier_connection';
    protected const DESCRIPTION = 'Get an AfterShip courier connection by ID.';
    protected const METHOD = 'getCourierConnection';

    public function parameters(): array
    {
        return AfterShipParameters::id();
    }
}
