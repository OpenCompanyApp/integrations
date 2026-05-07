<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve Restrictions for Item by CountryOfImport.
 *
 * Executes the official Avalara AvaTax REST API operation ListImportRestrictions.
 */
class AvalaraListImportRestrictions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_import_restrictions';
}