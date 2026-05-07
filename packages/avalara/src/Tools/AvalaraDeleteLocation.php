<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single location.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteLocation.
 */
class AvalaraDeleteLocation extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_location';
}