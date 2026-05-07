<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single subscription.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteSubscription.
 */
class AvalaraDeleteSubscription extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_subscription';
}