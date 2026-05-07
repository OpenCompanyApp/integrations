<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns link click metrics for an individual newsletter variantan individual language in a multi-language newsletter or a message in an A/B test.
 */
class CustomerIOAppGetVariantLinks extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_variant_links';
}
