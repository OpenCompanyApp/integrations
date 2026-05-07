<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create terms of service.
 *
 * Executes the official Box API operation post_terms_of_services.
 */
class BoxPostTermsOfServices extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_terms_of_services';
}
