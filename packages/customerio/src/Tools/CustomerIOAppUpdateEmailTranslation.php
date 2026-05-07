<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Update part of an email translation: the content, envelope, or transformers for a specific email translation.
 */
class CustomerIOAppUpdateEmailTranslation extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_update_email_translation';
}
