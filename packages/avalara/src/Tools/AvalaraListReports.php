<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all report tasks for account.
 *
 * Executes the official Avalara AvaTax REST API operation ListReports.
 */
class AvalaraListReports extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_reports';
}