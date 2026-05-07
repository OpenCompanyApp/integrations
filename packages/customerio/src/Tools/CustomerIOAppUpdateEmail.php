<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Update part of an email: an email's name, template status, folder, content, envelope, or transformers.
 */
class CustomerIOAppUpdateEmail extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_update_email';
}
