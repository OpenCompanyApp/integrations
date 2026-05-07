<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new subscription.
 *
 * Executes the official Avalara AvaTax REST API operation CreateSubscriptions.
 */
class AvalaraCreateSubscriptions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_subscriptions';
}