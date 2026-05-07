<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Get credit balance for the authenticated Stability AI account.
 */
class StabilityGetBalance extends AbstractStabilityTool
{
    protected const NAME = 'stability_get_balance';
    protected const DESCRIPTION = 'Get credit balance for the Stability AI API key.';
    protected const PARAMETERS = [];
    protected const OPERATION = ['method' => 'GET', 'path' => '/v1/user/balance'];
}
