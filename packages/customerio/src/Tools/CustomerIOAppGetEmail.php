<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a single email including content, envelope details, and transformers.
 */
class CustomerIOAppGetEmail extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_email';
}
