<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Change configuration settings for this company.
 *
 * Executes the official Avalara AvaTax REST API operation SetCompanyConfiguration.
 */
class AvalaraSetCompanyConfiguration extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_set_company_configuration';
}