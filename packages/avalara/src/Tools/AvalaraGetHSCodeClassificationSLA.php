<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the HS code classification SLA details for a company..
 *
 * Executes the official Avalara AvaTax REST API operation GetHSCodeClassificationSLA.
 */
class AvalaraGetHSCodeClassificationSLA extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_hs_code_classification_sla';
}