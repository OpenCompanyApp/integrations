<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a single email translation by language code, including content, envelope, and transformers.
 */
class CustomerIOAppGetEmailTranslation extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_email_translation';
}
