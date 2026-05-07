<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Find addresses suppressed by the Email Service Provider (ESP) for a particular reasonbounces, blocks, spam reports, or invalid email addresses.
 */
class CustomerIOAppGetSuppressionByType extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_suppression_by_type';
}
