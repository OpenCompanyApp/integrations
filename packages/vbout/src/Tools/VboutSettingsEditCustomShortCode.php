<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Settings Edit Custom Short Code tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutSettingsEditCustomShortCode extends AbstractVboutOperationTool
{
    protected const OPERATION = 'settings_edit_custom_short_code';
}