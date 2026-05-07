<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single company.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateCompany.
 */
class AvalaraUpdateCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_company';
}