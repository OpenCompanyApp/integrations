<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Add allowed origin.
 *
 * Executes the official Adyen management API operation post-me-allowedOrigins.
 */
class AdyenManagementPostMeAllowedOrigins extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_me_allowed_origins';
}
