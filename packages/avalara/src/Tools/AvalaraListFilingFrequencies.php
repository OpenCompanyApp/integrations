<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported filing frequencies..
 *
 * Executes the official Avalara AvaTax REST API operation ListFilingFrequencies.
 */
class AvalaraListFilingFrequencies extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_filing_frequencies';
}