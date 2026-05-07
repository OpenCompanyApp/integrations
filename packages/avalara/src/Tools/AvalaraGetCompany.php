<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single company.
 *
 * Executes the official Avalara AvaTax REST API operation GetCompany.
 */
class AvalaraGetCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_company';
}