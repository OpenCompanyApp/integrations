<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Generates a signed token and URL for a person's standalone subscription center page.
 */
class CustomerIOAppGetSubscriptionCenterToken extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_subscription_center_token';
}
