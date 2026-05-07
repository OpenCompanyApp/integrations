<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Create a newsletter and optionally schedule it or send it immediately.
 */
class CustomerIOAppCreateNewsletter extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_create_newsletter';
}
