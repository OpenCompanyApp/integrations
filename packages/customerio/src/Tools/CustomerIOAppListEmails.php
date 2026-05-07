<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a paginated list of emails and a separate array of folders that the emails belong to.
 */
class CustomerIOAppListEmails extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_list_emails';
}
