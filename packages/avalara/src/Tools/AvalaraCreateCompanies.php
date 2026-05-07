<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create new companies.
 *
 * Executes the official Avalara AvaTax REST API operation CreateCompanies.
 */
class AvalaraCreateCompanies extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_companies';
}