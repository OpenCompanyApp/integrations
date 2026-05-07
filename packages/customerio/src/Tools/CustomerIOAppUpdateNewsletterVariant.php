<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Update the content of a newsletter: the default message, a test variant in an A/B test group, or a translation.
 */
class CustomerIOAppUpdateNewsletterVariant extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_update_newsletter_variant';
}
