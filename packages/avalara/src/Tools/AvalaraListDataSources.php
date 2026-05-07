<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all datasources for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListDataSources.
 */
class AvalaraListDataSources extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_data_sources';
}