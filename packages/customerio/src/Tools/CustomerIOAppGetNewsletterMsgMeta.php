<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns information about the "deliveries" (rendered messages) sent to your recipients for a specific newsletter.
 */
class CustomerIOAppGetNewsletterMsgMeta extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_newsletter_msg_meta';
}
