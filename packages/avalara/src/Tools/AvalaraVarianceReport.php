<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Generates the Variance report which will capture the difference between "Tax Calculated by Avalara" Vs "Actual Tax" paid at custom clearance at line / header level..
 *
 * Executes the official Avalara AvaTax REST API operation VarianceReport.
 */
class AvalaraVarianceReport extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_variance_report';
}