<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Checks if the current user is subscribed to a specific service.
 *
 * Executes the official Avalara AvaTax REST API operation GetMySubscription.
 */
class AvalaraGetMySubscription extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_my_subscription';
}