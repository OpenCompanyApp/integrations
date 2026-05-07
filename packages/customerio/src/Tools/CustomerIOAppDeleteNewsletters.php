<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Deletes an individual newsletter, including content, settings, and metrics.
 */
class CustomerIOAppDeleteNewsletters extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_delete_newsletters';
}
