<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns metrics for link clicks within a newsletter, both in total and in series periods (days, weeks, etc).
 */
class CustomerIOAppGetNewsletterLinks extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_newsletter_links';
}
