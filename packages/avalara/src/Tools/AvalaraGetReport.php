<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single report.
 *
 * Executes the official Avalara AvaTax REST API operation GetReport.
 */
class AvalaraGetReport extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_report';
}