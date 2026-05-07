<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported subscription types.
 *
 * Executes the official Avalara AvaTax REST API operation ListSubscriptionTypes.
 */
class AvalaraListSubscriptionTypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_subscription_types';
}