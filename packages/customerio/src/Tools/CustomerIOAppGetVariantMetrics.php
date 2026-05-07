<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a metrics for an individual newsletter varianteither an individual language in a multi-language newsletter or a message in an A/B test.
 */
class CustomerIOAppGetVariantMetrics extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_variant_metrics';
}
