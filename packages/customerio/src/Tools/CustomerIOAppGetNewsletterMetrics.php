<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a list of metrics for an individual newsletter in steps (days, weeks, etc).
 */
class CustomerIOAppGetNewsletterMetrics extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_newsletter_metrics';
}
