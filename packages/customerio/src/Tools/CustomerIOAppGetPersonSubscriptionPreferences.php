<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a list of subscription preferences for a person, including the custom header of the subscription preferences page, topic names, and topic descriptions.
 */
class CustomerIOAppGetPersonSubscriptionPreferences extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_person_subscription_preferences';
}
