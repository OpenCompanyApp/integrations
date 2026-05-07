<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Dismiss the `Status` and `Details` values of the given ItemHSCodeClassificationStatus..
 *
 * Executes the official Avalara AvaTax REST API operation DismissHSCodeClassificationStatus.
 */
class AvalaraDismissHSCodeClassificationStatus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_dismiss_hs_code_classification_status';
}