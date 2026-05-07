<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax authorities..
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxAuthorities.
 */
class AvalaraListTaxAuthorities extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_authorities';
}