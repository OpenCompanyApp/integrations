<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Find addresses suppressed by the Email Service Provider (ESP) for a particular reason on a specific sending domain.
 */
class CustomerIOAppGetDomainSuppressionsByType extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_domain_suppressions_by_type';
}
