<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get allowed origins.
 *
 * Executes the official Adyen management API operation get-me-allowedOrigins.
 */
class AdyenManagementGetMeAllowedOrigins extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_me_allowed_origins';
}
