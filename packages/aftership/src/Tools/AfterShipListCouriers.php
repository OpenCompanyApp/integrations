<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * List AfterShip couriers.
 */
class AfterShipListCouriers extends AbstractAfterShipTool
{
    protected const NAME = 'aftership_list_couriers';
    protected const DESCRIPTION = 'List AfterShip supported couriers.';
    protected const METHOD = 'listCouriers';
}
