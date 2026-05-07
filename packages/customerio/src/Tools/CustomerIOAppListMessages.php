<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Return a list of deliveries, including metrics for each delivery, for messages in your workspace.
 */
class CustomerIOAppListMessages extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_list_messages';
}
