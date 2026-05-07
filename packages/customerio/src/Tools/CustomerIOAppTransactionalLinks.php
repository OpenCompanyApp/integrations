<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns metrics for clicked links from a transactional message, both in total and in series periods (days, weeks, etc).
 */
class CustomerIOAppTransactionalLinks extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_transactional_links';
}
