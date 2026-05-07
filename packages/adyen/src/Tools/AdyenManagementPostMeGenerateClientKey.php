<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Generate a client key.
 *
 * Executes the official Adyen management API operation post-me-generateClientKey.
 */
class AdyenManagementPostMeGenerateClientKey extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_me_generate_client_key';
}
