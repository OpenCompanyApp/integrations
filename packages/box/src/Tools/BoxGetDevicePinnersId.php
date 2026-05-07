<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get device pin.
 *
 * Executes the official Box API operation get_device_pinners_id.
 */
class BoxGetDevicePinnersId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_device_pinners_id';
}
