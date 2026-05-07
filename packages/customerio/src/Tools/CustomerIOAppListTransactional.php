<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a list of your transactional messagesthe transactional IDs that you use to trigger an individual transactional delivery.
 */
class CustomerIOAppListTransactional extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_list_transactional';
}
