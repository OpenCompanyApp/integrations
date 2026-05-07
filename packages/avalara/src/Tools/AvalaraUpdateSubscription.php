<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single subscription.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateSubscription.
 */
class AvalaraUpdateSubscription extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_subscription';
}