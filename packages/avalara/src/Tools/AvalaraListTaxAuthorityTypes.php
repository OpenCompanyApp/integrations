<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax authority types..
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxAuthorityTypes.
 */
class AvalaraListTaxAuthorityTypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_authority_types';
}