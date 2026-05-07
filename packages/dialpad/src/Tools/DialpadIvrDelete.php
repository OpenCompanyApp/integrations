<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Custom IVR -- Delete.
 *
 * Executes the official Dialpad API operation ivr.delete.
 */
class DialpadIvrDelete extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_ivr_delete';
}
