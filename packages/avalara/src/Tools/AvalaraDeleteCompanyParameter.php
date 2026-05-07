<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single company parameter.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteCompanyParameter.
 */
class AvalaraDeleteCompanyParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_company_parameter';
}