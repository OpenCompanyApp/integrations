<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns information about each test group in a newsletter, including content ids for each group.
 */
class CustomerIOAppGetNewsletterTestGroups extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_newsletter_test_groups';
}
