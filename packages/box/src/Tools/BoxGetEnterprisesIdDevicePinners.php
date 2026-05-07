<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List enterprise device pins.
 *
 * Executes the official Box API operation get_enterprises_id_device_pinners.
 */
class BoxGetEnterprisesIdDevicePinners extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_enterprises_id_device_pinners';
}
