<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Delete an AfterShip courier connection.
 */
class AfterShipDeleteCourierConnection extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_delete_courier_connection';
    protected const DESCRIPTION = 'Delete an AfterShip courier connection by ID.';
    protected const METHOD = 'deleteCourierConnection';

    public function parameters(): array
    {
        return AfterShipParameters::id();
    }
}
