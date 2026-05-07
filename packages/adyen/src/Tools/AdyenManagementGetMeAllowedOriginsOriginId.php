<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get allowed origin details.
 *
 * Executes the official Adyen management API operation get-me-allowedOrigins-originId.
 */
class AdyenManagementGetMeAllowedOriginsOriginId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_me_allowed_origins_origin_id';
}
