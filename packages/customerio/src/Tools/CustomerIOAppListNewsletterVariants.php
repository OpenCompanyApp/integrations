<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a newsletter's content variantsthese are either different languages in a multi-language newsletter or A/B tests.
 */
class CustomerIOAppListNewsletterVariants extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_list_newsletter_variants';
}
