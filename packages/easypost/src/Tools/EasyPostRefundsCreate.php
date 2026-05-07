<?php

namespace OpenCompany\Integrations\EasyPost\Tools;

/**
 * Bulk request refunds by carrier and tracking codes.
 */
class EasyPostRefundsCreate extends AbstractEasyPostTool
{
    protected const OPERATION = 'refunds_create';
}
