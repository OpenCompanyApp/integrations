<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Quick setup for a company with a single physical address.
 *
 * Executes the official Avalara AvaTax REST API operation CompanyInitialize.
 */
class AvalaraCompanyInitialize extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_company_initialize';
}