<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Custom IVR -- Assign.
 *
 * Executes the official Dialpad API operation ivr.update.
 */
class DialpadIvrUpdate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_ivr_update';
}
