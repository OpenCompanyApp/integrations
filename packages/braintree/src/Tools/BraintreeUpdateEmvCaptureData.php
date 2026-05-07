<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Emv Capture Data.
 *
 * Executes the official Braintree GraphQL field updateEmvCaptureData.
 */
class BraintreeUpdateEmvCaptureData extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_emv_capture_data';
}
