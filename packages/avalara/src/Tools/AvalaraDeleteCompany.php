<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single company.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteCompany.
 */
class AvalaraDeleteCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_company';
}