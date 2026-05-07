<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all subscriptions.
 *
 * Executes the official Avalara AvaTax REST API operation QuerySubscriptions.
 */
class AvalaraQuerySubscriptions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_subscriptions';
}