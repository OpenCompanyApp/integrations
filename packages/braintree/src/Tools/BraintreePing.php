<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Ping.
 *
 * Executes the official Braintree GraphQL field ping.
 */
class BraintreePing extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_ping';
}
