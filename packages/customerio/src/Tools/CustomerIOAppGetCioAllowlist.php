<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a list of IP addresses that you need to allowlist if you're using a firewall or provider's IP access management settings to deny access to unknown IP addresses.
 */
class CustomerIOAppGetCioAllowlist extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_cio_allowlist';
}
