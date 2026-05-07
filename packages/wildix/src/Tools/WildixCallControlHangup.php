<?php

namespace OpenCompany\Integrations\Wildix\Tools;

/**
 * Call Control Hangup using the official Wildix WMS/PBX API.
 */
class WildixCallControlHangup extends AbstractWildixOperationTool
{
    protected const OPERATION = 'call_control_hangup';
}
