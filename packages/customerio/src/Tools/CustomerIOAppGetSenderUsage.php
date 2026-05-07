<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns lists of the campaigns and newsletters that use a sender.
 */
class CustomerIOAppGetSenderUsage extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_sender_usage';
}
