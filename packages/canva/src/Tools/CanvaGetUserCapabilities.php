<?php

namespace OpenCompany\Integrations\Canva\Tools;

/**
 * Lists the API capabilities for the user account associated with the provided access token.
 */
class CanvaGetUserCapabilities extends AbstractCanvaOperationTool
{
    protected const OPERATION = 'canva_get_user_capabilities';
}
