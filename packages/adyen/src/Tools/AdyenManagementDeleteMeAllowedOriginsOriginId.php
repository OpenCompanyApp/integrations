<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Remove allowed origin.
 *
 * Executes the official Adyen management API operation delete-me-allowedOrigins-originId.
 */
class AdyenManagementDeleteMeAllowedOriginsOriginId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_delete_me_allowed_origins_origin_id';
}
