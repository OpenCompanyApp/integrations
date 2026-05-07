<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported forms for each tax authority..
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxAuthorityForms.
 */
class AvalaraListTaxAuthorityForms extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_authority_forms';
}