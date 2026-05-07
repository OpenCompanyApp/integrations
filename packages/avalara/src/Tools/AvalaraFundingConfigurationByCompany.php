<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Check the funding configuration of a company.
 *
 * Executes the official Avalara AvaTax REST API operation FundingConfigurationByCompany.
 */
class AvalaraFundingConfigurationByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_funding_configuration_by_company';
}