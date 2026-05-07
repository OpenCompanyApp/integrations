<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Check the funding configuration of a company.
 *
 * Executes the official Avalara AvaTax REST API operation FundingConfigurationsByCompanyAndCurrency.
 */
class AvalaraFundingConfigurationsByCompanyAndCurrency extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_funding_configurations_by_company_and_currency';
}