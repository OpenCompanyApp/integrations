<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single subscription.
 *
 * Executes the official Avalara AvaTax REST API operation GetSubscription.
 */
class AvalaraGetSubscription extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_subscription';
}