<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all batches for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListBatchesByCompany.
 */
class AvalaraListBatchesByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_batches_by_company';
}