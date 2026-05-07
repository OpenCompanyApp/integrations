<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Look up an email address to learn if, and why, it was suppressed by the email service provider (ESP).
 */
class CustomerIOAppGetSuppression extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_suppression';
}
