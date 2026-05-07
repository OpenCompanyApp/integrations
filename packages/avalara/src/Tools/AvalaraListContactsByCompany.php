<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve contacts for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListContactsByCompany.
 */
class AvalaraListContactsByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_contacts_by_company';
}