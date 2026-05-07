<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Call -- Initiate IVR Call.
 *
 * Executes the official Dialpad API operation call.initiate_ivr_call.
 */
class DialpadCallInitiateIvrCall extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_call_initiate_ivr_call';
}
