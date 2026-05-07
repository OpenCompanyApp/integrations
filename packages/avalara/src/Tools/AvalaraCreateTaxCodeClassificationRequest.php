<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new tax code classification request.
 *
 * Executes the official Avalara AvaTax REST API operation CreateTaxCodeClassificationRequest.
 */
class AvalaraCreateTaxCodeClassificationRequest extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_tax_code_classification_request';
}