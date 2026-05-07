<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove device pin.
 *
 * Executes the official Box API operation delete_device_pinners_id.
 */
class BoxDeleteDevicePinnersId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_device_pinners_id';
}
