<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Get account details for the authenticated Stability AI API key.
 */
class StabilityGetAccount extends AbstractStabilityTool
{
    protected const NAME = 'stability_get_account';
    protected const DESCRIPTION = 'Get the account associated with the Stability AI API key.';
    protected const PARAMETERS = [];
    protected const OPERATION = ['method' => 'GET', 'path' => '/v1/user/account'];
}
