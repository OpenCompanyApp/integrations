<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create an HS code classification request..
 *
 * Executes the official Avalara AvaTax REST API operation InitiateHSCodeClassification.
 */
class AvalaraInitiateHSCodeClassification extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_initiate_hs_code_classification';
}