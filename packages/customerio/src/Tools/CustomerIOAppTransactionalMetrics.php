<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a list of metrics for a transactional message in steps (days, weeks, etc).
 */
class CustomerIOAppTransactionalMetrics extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_transactional_metrics';
}
