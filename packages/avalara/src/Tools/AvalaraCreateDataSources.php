<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create and store new datasources for the respective companies..
 *
 * Executes the official Avalara AvaTax REST API operation CreateDataSources.
 */
class AvalaraCreateDataSources extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_data_sources';
}