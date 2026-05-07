<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns information about the deliveries (instances of messages sent to individual people) from a transactional message.
 */
class CustomerIOAppTransactionalMessages extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_transactional_messages';
}
