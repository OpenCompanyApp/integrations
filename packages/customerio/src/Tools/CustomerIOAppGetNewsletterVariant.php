<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns information about a specific variant of a newsletter, where a variant is either a language in a multi-language newsletter or a part of an A/B test.
 */
class CustomerIOAppGetNewsletterVariant extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_newsletter_variant';
}
