<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all datasources.
 *
 * Executes the official Avalara AvaTax REST API operation QueryDataSources.
 */
class AvalaraQueryDataSources extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_data_sources';
}