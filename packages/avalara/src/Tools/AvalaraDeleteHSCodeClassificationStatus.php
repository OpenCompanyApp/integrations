<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Deletes HS Code classification status for the item by status id..
 *
 * Executes the official Avalara AvaTax REST API operation DeleteHSCodeClassificationStatus.
 */
class AvalaraDeleteHSCodeClassificationStatus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_hs_code_classification_status';
}