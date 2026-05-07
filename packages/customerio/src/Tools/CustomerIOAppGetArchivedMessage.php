<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns the archived copy of a delivery, including the message body, recipient, and metrics.
 */
class CustomerIOAppGetArchivedMessage extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_archived_message';
}
