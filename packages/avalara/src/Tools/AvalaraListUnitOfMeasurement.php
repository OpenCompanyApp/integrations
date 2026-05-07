<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all defined units of measurement.
 *
 * Executes the official Avalara AvaTax REST API operation ListUnitOfMeasurement.
 */
class AvalaraListUnitOfMeasurement extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_unit_of_measurement';
}