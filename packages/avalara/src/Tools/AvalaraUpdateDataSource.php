<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a datasource identified by id for a company.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateDataSource.
 */
class AvalaraUpdateDataSource extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_data_source';
}