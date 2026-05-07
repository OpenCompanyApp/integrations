<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all services to which the current user is subscribed.
 *
 * Executes the official Avalara AvaTax REST API operation ListMySubscriptions.
 */
class AvalaraListMySubscriptions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_my_subscriptions';
}