<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a datasource by datasource id for a company..
 *
 * Executes the official Avalara AvaTax REST API operation DeleteDataSource.
 */
class AvalaraDeleteDataSource extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_data_source';
}