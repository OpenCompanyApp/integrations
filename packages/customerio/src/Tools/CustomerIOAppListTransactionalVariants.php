<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns the content variants of a transactional message, where each variant represents a different language.
 */
class CustomerIOAppListTransactionalVariants extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_list_transactional_variants';
}
