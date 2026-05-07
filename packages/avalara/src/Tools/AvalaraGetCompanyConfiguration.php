<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get configuration settings for this company.
 *
 * Executes the official Avalara AvaTax REST API operation GetCompanyConfiguration.
 */
class AvalaraGetCompanyConfiguration extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_company_configuration';
}