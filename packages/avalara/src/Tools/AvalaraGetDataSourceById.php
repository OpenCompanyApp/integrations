<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get data source by data source id.
 *
 * Executes the official Avalara AvaTax REST API operation GetDataSourceById.
 */
class AvalaraGetDataSourceById extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_data_source_by_id';
}