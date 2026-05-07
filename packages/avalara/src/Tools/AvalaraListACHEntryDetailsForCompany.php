<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get ACH entry detail report for company and period.
 *
 * Executes the official Avalara AvaTax REST API operation ListACHEntryDetailsForCompany.
 */
class AvalaraListACHEntryDetailsForCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_ach_entry_details_for_company';
}