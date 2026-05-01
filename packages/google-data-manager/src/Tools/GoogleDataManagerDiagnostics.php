<?php

namespace OpenCompany\Integrations\GoogleDataManager\Tools;

/**
 * Show safe Google Data Manager configuration diagnostics.
 */
class GoogleDataManagerDiagnostics extends GoogleDataManagerTool
{
    protected const ACTION = 'diagnostics';
    protected const NAME = 'google_data_manager_diagnostics';
    protected const DESCRIPTION = 'Show safe Google Data Manager configuration diagnostics without exposing secrets.';
}
