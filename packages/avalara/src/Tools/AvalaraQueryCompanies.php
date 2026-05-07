<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all companies.
 *
 * Executes the official Avalara AvaTax REST API operation QueryCompanies.
 */
class AvalaraQueryCompanies extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_companies';
}