<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Settings Custom Short codes tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutSettingsCustomShortcodes extends AbstractVboutOperationTool
{
    protected const OPERATION = 'settings_custom_shortcodes';
}